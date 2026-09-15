
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import 'package:nexa_app/models/user_model.dart';
import 'package:nexa_app/services/api_service.dart';
import 'package:nexa_app/views/dashboard_page_fun.dart';
import 'package:nexa_app/views/dashboard_cameras.dart';
import 'package:nexa_app/views/institucional_page.dart';
import 'package:provider/provider.dart';

class PerfilPage extends StatefulWidget {
  const PerfilPage({super.key});

  @override
  State<PerfilPage> createState() => _PerfilPageState();
}

class _PerfilPageState extends State<PerfilPage> {
  bool editando = false;
  bool alterarSenha = false;
  bool carregando = true;
  bool salvando = false;

  late TextEditingController nomeController;
  late TextEditingController emailController;
  late TextEditingController telefoneController;
  late TextEditingController cpfController;
  late TextEditingController dataController;
  late TextEditingController uidController;

  late TextEditingController senhaAtualController;
  late TextEditingController novaSenhaController;
  late TextEditingController confirmarSenhaController;

  String mensagem = '';
  bool mensagemErro = false;

  @override
  void initState() {
    super.initState();

    nomeController = TextEditingController();
    emailController = TextEditingController();
    telefoneController = TextEditingController();
    cpfController = TextEditingController();
    dataController = TextEditingController();
    uidController = TextEditingController();

    senhaAtualController = TextEditingController();
    novaSenhaController = TextEditingController();
    confirmarSenhaController = TextEditingController();

    carregarPerfil();
  }

  // =========================================================
  // CARREGAR PERFIL DA API
  // =========================================================

  Future<void> carregarPerfil() async {
    try {
      final usuario = await ApiService.buscarPerfilFuncionario(
        usuarioLogado.cpf,
      );

      usuarioLogado = usuario;

      nomeController.text = usuario.nome;
      emailController.text = usuario.email;
      telefoneController.text = formatarTelefone(
        usuario.telefone,
      );
      cpfController.text = usuario.cpf;
      dataController.text = usuario.dataNascimento;
      uidController.text = usuario.uidRfid;

      if (mounted) {
        setState(() {
          carregando = false;
        });
      }
    } catch (e) {
      if (mounted) {
        setState(() {
          carregando = false;
          mensagemErro = true;
          mensagem = e.toString().replaceFirst(
                'Exception: ',
                '',
              );
        });
      }
    }
  }

  // =========================================================
  // URL DA IMAGEM DO EPI
  // =========================================================

  String _urlImagemEpi(String imagem) {
    if (imagem.trim().isEmpty) {
      return '';
    }

    imagem = imagem.trim();

    // Caso a API já envie uma URL completa
    if (imagem.startsWith('http://') ||
        imagem.startsWith('https://')) {
      return imagem;
    }

    // Remove barras do começo
    imagem = imagem.replaceFirst(
      RegExp(r'^/+'),
      '',
    );

    // Caso já venha com uploads/epis/
    if (imagem.startsWith('uploads/epis/')) {
      return '${ApiService.baseUrl}/$imagem';
    }

    // Caso venha somente o nome do arquivo
    return '${ApiService.baseUrl}/uploads/epis/$imagem';
  }

  // =========================================================
  // MÁSCARA TELEFONE
  // =========================================================

  String formatarTelefone(String valor) {
    String numeros = valor.replaceAll(
      RegExp(r'[^0-9]'),
      '',
    );

    if (numeros.length > 11) {
      numeros = numeros.substring(0, 11);
    }

    if (numeros.length <= 2) {
      return numeros;
    }

    if (numeros.length <= 7) {
      return '(${numeros.substring(0, 2)}) '
          '${numeros.substring(2)}';
    }

    return '(${numeros.substring(0, 2)}) '
        '${numeros.substring(2, 7)}-'
        '${numeros.substring(7)}';
  }

  // =========================================================
  // SALVAR ALTERAÇÕES
  // =========================================================

  Future<void> salvarAlteracoes() async {
    if (salvando) return;

    setState(() {
      salvando = true;
      mensagem = '';
      mensagemErro = false;
    });

    try {
      // =====================================================
      // ATUALIZAR DADOS PESSOAIS
      // =====================================================

      await ApiService.atualizarPerfil(
        usuarioLogado.cpf,
        nome: nomeController.text.trim(),
        email: emailController.text.trim(),
        telefone: telefoneController.text.trim(),
      );

      // =====================================================
      // ALTERAR SENHA SOMENTE SE FOI PREENCHIDA
      // =====================================================

      if (novaSenhaController.text.trim().isNotEmpty) {
        if (senhaAtualController.text.trim().isEmpty) {
          throw Exception(
            'Digite sua senha atual para alterar a senha.',
          );
        }

        if (novaSenhaController.text !=
            confirmarSenhaController.text) {
          throw Exception(
            'A nova senha e a confirmação não coincidem.',
          );
        }

        await ApiService.alterarSenha(
          usuarioLogado.cpf,
          senhaAtual: senhaAtualController.text,
          novaSenha: novaSenhaController.text,
        );
      }

      // =====================================================
      // BUSCAR PERFIL NOVAMENTE
      // =====================================================

      final usuarioAtualizado =
          await ApiService.buscarPerfilFuncionario(
        usuarioLogado.cpf,
      );

      usuarioLogado = usuarioAtualizado;

      nomeController.text = usuarioAtualizado.nome;
      emailController.text = usuarioAtualizado.email;
      telefoneController.text = formatarTelefone(
        usuarioAtualizado.telefone,
      );

      senhaAtualController.clear();
      novaSenhaController.clear();
      confirmarSenhaController.clear();

      if (mounted) {
        setState(() {
          editando = false;
          alterarSenha = false;
          salvando = false;
          mensagemErro = false;
          mensagem = 'Perfil atualizado com sucesso!';
        });
      }
    } catch (e) {
      if (mounted) {
        setState(() {
          salvando = false;
          mensagemErro = true;
          mensagem = e.toString().replaceFirst(
                'Exception: ',
                '',
              );
        });
      }
    }
  }

  @override
  void dispose() {
    nomeController.dispose();
    emailController.dispose();
    telefoneController.dispose();
    cpfController.dispose();
    dataController.dispose();
    uidController.dispose();

    senhaAtualController.dispose();
    novaSenhaController.dispose();
    confirmarSenhaController.dispose();

    super.dispose();
  }

  // =========================================================
  // BUILD
  // =========================================================

  @override
  Widget build(BuildContext context) {
    final accessibility =
        context.watch<AccessibilityController>();

    bool isDarkMode = false;

    try {
      isDarkMode =
          (accessibility as dynamic).darkMode ??
          (accessibility as dynamic).isDarkMode ??
          false;
    } catch (_) {
      isDarkMode = false;
    }

    final Color backgroundColor = isDarkMode
        ? const Color(0xFF000000)
        : const Color(0xFFF3F5F9);

    final Color appBarColor = isDarkMode
        ? const Color(0xFF1A2B4C)
        : Colors.white;

    final Color cardColor = isDarkMode
        ? const Color(0xFF1A2B4C)
        : Colors.white;

    final Color textColor = isDarkMode
        ? Colors.white
        : const Color(0xFF161616);

    final Color subTextColor = isDarkMode
        ? Colors.white70
        : Colors.grey;

    final Color fieldFillColor = isDarkMode
        ? const Color(0xFF2A3B5C)
        : const Color(0xFFF4F6FA);

    return Scaffold(
      backgroundColor: backgroundColor,

      // =====================================================
      // DRAWER
      // =====================================================

      drawer: _buildDrawer(context),

      // =====================================================
      // APP BAR
      // =====================================================

      appBar: AppBar(
        elevation: 0,
        backgroundColor: appBarColor,
        iconTheme: const IconThemeData(
          color: Color(0xFF0F62FE),
        ),
        title: Text(
          'Perfil',
          style: TextStyle(
            color: isDarkMode
                ? Colors.white
                : const Color(0xFF0F62FE),
            fontWeight: FontWeight.bold,
          ),
        ),
        actions: [
          IconButton(
            icon: const Icon(
              Icons.text_increase,
              color: Color(0xFF0F62FE),
            ),
            onPressed: () {
              context
                  .read<AccessibilityController>()
                  .aumentarFonte();
            },
          ),

          IconButton(
            icon: const Icon(
              Icons.text_decrease,
              color: Color(0xFF0F62FE),
            ),
            onPressed: () {
              context
                  .read<AccessibilityController>()
                  .diminuirFonte();
            },
          ),

          IconButton(
            icon: Icon(
              isDarkMode
                  ? Icons.wb_sunny
                  : Icons.nightlight_round,
              color: const Color(0xFF0F62FE),
            ),
            onPressed: () {
              try {
                (context
                        .read<AccessibilityController>()
                    as dynamic)
                    .toggleDarkMode();
              } catch (_) {
                try {
                  (context
                          .read<AccessibilityController>()
                      as dynamic)
                      .alternarTema();
                } catch (_) {}
              }
            },
          ),

          IconButton(
            icon: const Icon(
              Icons.volume_up,
              color: Color(0xFF0F62FE),
            ),
            onPressed: () {
              context
                  .read<AccessibilityController>()
                  .lerTexto(
                    '''
Perfil do Funcionário.
Nome: ${nomeController.text}.
E-mail: ${emailController.text}.
Telefone: ${telefoneController.text}.
EPIs obrigatórios: ${usuarioLogado.epis}.
''',
                  );
            },
          ),

          const SizedBox(width: 10),
        ],
      ),

      // =====================================================
      // BODY
      // =====================================================

      body: carregando
          ? const Center(
              child: CircularProgressIndicator(
                color: Color(0xFF0F62FE),
              ),
            )
          : Center(
              child: SingleChildScrollView(
                padding: const EdgeInsets.symmetric(
                  vertical: 30,
                  horizontal: 20,
                ),
                child: Container(
                  width: 850,
                  padding: const EdgeInsets.all(32),
                  decoration: BoxDecoration(
                    color: cardColor,
                    borderRadius: BorderRadius.circular(20),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.03),
                        blurRadius: 15,
                        offset: const Offset(0, 5),
                      ),
                    ],
                  ),
                  child: Column(
                    crossAxisAlignment:
                        CrossAxisAlignment.start,
                    children: [

                      // =================================================
                      // HEADER
                      // =================================================

                      _buildHeader(
                        isDarkMode,
                        subTextColor,
                      ),

                      const SizedBox(height: 38),

                      // =================================================
                      // INFORMAÇÕES PESSOAIS
                      // =================================================

                      _secaoTitulo(
                        Icons.person_outline,
                        'INFORMAÇÕES PESSOAIS',
                      ),

                      const SizedBox(height: 18),

                      campo(
                        'Nome completo',
                        nomeController,
                        icon: Icons.person_outline,
                        textColor: textColor,
                        fillColor: fieldFillColor,
                      ),

                      campo(
                        'E-mail corporativo',
                        emailController,
                        icon: Icons.email_outlined,
                        textColor: textColor,
                        fillColor: fieldFillColor,
                      ),

                      campo(
                        'Telefone',
                        telefoneController,
                        icon: Icons.phone_outlined,
                        textColor: textColor,
                        fillColor: fieldFillColor,
                        keyboardType:
                            TextInputType.phone,
                        inputFormatters: [
                          FilteringTextInputFormatter
                              .digitsOnly,
                          LengthLimitingTextInputFormatter(
                            11,
                          ),
                          _TelefoneInputFormatter(),
                        ],
                      ),

                      campo(
                        'CPF',
                        cpfController,
                        icon: Icons.badge_outlined,
                        enabled: false,
                        textColor: textColor,
                        fillColor: fieldFillColor,
                      ),

                      campo(
                        'Data de nascimento',
                        dataController,
                        icon:
                            Icons.calendar_today_outlined,
                        enabled: false,
                        textColor: textColor,
                        fillColor: fieldFillColor,
                      ),

                      campo(
                        'Código RFID',
                        uidController,
                        icon: Icons.nfc_outlined,
                        enabled: false,
                        textColor: textColor,
                        fillColor: fieldFillColor,
                      ),

                      const SizedBox(height: 22),

                      // =================================================
                      // VÍNCULO PROFISSIONAL
                      // =================================================

                      _secaoTitulo(
                        Icons.business_outlined,
                        'VÍNCULO PROFISSIONAL',
                      ),

                      const SizedBox(height: 18),

                      campo(
                        'Empresa',
                        TextEditingController(
                          text: usuarioLogado.empresa,
                        ),
                        icon: Icons.business_outlined,
                        enabled: false,
                        textColor: textColor,
                        fillColor: fieldFillColor,
                      ),

                      campo(
                        'Setor',
                        TextEditingController(
                          text: usuarioLogado.setor,
                        ),
                        icon: Icons.work_outline,
                        enabled: false,
                        textColor: textColor,
                        fillColor: fieldFillColor,
                      ),

                      const SizedBox(height: 22),

                      // =================================================
                      // EPIs OBRIGATÓRIOS
                      // =================================================

                      _secaoTitulo(
                        Icons.shield_outlined,
                        'EPIS OBRIGATÓRIOS',
                      ),

                      const SizedBox(height: 18),

                      _buildEpis(
                        textColor,
                        fieldFillColor,
                      ),

                      const SizedBox(height: 30),

                      // =================================================
                      // SEGURANÇA
                      // =================================================

                      _secaoTitulo(
                        Icons.lock_outline,
                        'SEGURANÇA',
                      ),

                      const SizedBox(height: 18),

                      if (alterarSenha) ...[
                        campo(
                          'Senha atual',
                          senhaAtualController,
                          icon: Icons.lock_outline,
                          oculto: true,
                          textColor: textColor,
                          fillColor: fieldFillColor,
                        ),

                        campo(
                          'Nova senha',
                          novaSenhaController,
                          icon: Icons.lock_outline,
                          oculto: true,
                          textColor: textColor,
                          fillColor: fieldFillColor,
                        ),

                        campo(
                          'Confirmar nova senha',
                          confirmarSenhaController,
                          icon: Icons.lock_outline,
                          oculto: true,
                          textColor: textColor,
                          fillColor: fieldFillColor,
                        ),

                        const SizedBox(height: 5),

                        TextButton.icon(
                          onPressed: () {
                            setState(() {
                              alterarSenha = false;
                              senhaAtualController.clear();
                              novaSenhaController.clear();
                              confirmarSenhaController.clear();
                            });
                          },
                          icon: const Icon(
                            Icons.close,
                            size: 18,
                          ),
                          label: const Text(
                            'Cancelar alteração de senha',
                          ),
                        ),
                      ],

                      if (mensagem.isNotEmpty)
                        Padding(
                          padding: const EdgeInsets.only(
                            top: 8,
                          ),
                          child: Text(
                            mensagem,
                            style: TextStyle(
                              color: mensagemErro
                                  ? Colors.red
                                  : Colors.green,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ),

                      const SizedBox(height: 30),

                      // =================================================
                      // BOTÕES
                      // =================================================

                      Row(
                        mainAxisAlignment:
                            MainAxisAlignment.center,
                        children: [

                          if (!alterarSenha)
                            OutlinedButton.icon(
                              onPressed: () {
                                setState(() {
                                  alterarSenha = true;
                                  editando = true;
                                  mensagem = '';
                                });
                              },
                              icon: const Icon(
                                Icons.lock_reset,
                              ),
                              label: const Text(
                                'Alterar senha',
                              ),
                              style:
                                  OutlinedButton.styleFrom(
                                foregroundColor:
                                    const Color(0xFF0F62FE),
                                padding:
                                    const EdgeInsets.symmetric(
                                  horizontal: 25,
                                  vertical: 15,
                                ),
                                shape:
                                    RoundedRectangleBorder(
                                  borderRadius:
                                      BorderRadius.circular(25),
                                ),
                              ),
                            ),

                          if (!alterarSenha)
                            const SizedBox(width: 12),

                          ElevatedButton.icon(
                            icon: salvando
                                ? const SizedBox(
                                    width: 18,
                                    height: 18,
                                    child:
                                        CircularProgressIndicator(
                                      strokeWidth: 2,
                                      color: Colors.white,
                                    ),
                                  )
                                : Icon(
                                    editando
                                        ? Icons.save
                                        : Icons.edit_note_rounded,
                                  ),
                            label: Text(
                              salvando
                                  ? 'Salvando...'
                                  : editando
                                      ? 'Salvar alterações'
                                      : 'Editar campos',
                            ),
                            style:
                                ElevatedButton.styleFrom(
                              backgroundColor:
                                  const Color(0xFF0F62FE),
                              foregroundColor: Colors.white,
                              padding:
                                  const EdgeInsets.symmetric(
                                horizontal: 30,
                                vertical: 16,
                              ),
                              shape:
                                  RoundedRectangleBorder(
                                borderRadius:
                                    BorderRadius.circular(25),
                              ),
                            ),
                            onPressed: salvando
                                ? null
                                : () {
                                    if (editando) {
                                      salvarAlteracoes();
                                    } else {
                                      setState(() {
                                        editando = true;
                                        mensagem = '';
                                      });
                                    }
                                  },
                          ),
                        ],
                      ),
                    ],
                  ),
                ),
              ),
            ),
    );
  }

  // =========================================================
  // EPIs
  // =========================================================

  Widget _buildEpis(
    Color textColor,
    Color fillColor,
  ) {
    final epis = usuarioLogado.episObrigatorios;

    if (epis.isEmpty) {
      return Container(
        width: double.infinity,
        padding: const EdgeInsets.all(20),
        decoration: BoxDecoration(
          color: fillColor,
          borderRadius: BorderRadius.circular(12),
        ),
        child: const Row(
          children: [
            Icon(
              Icons.info_outline,
              color: Colors.grey,
            ),
            SizedBox(width: 10),
            Expanded(
              child: Text(
                'Nenhum EPI obrigatório cadastrado.',
              ),
            ),
          ],
        ),
      );
    }

    return Column(
      children: epis.map((epi) {

        final String imagemUrl =
            _urlImagemEpi(epi.imagem);

        return Container(
          width: double.infinity,

          // MAIS ESPAÇO ENTRE OS EPIs
          margin: const EdgeInsets.only(
            bottom: 16,
          ),

          padding: const EdgeInsets.all(16),

          decoration: BoxDecoration(
            color: fillColor,
            borderRadius: BorderRadius.circular(14),
          ),

          child: Row(
            crossAxisAlignment:
                CrossAxisAlignment.center,

            children: [

              // =================================================
              // IMAGEM
              // =================================================

              Container(
                width: 78,
                height: 78,

                decoration: BoxDecoration(
                  color: const Color(0xFF0F62FE)
                      .withOpacity(0.10),
                  borderRadius:
                      BorderRadius.circular(12),
                ),

                child: imagemUrl.isNotEmpty
                    ? ClipRRect(
                        borderRadius:
                            BorderRadius.circular(12),

                        child:Container(
  width: 78,
  height: 78,
  decoration: BoxDecoration(
    color: const Color(0xFFEAF4FF),
    borderRadius: BorderRadius.circular(16),
  ),
  child: const Icon(
    Icons.shield_outlined,
    color: Color(0xFF0075E3),
    size: 40,
  ),
),
                      )
                    : const Icon(
                        Icons.shield_outlined,
                        color: Color(0xFF0F62FE),
                        size: 34,
                      ),
              ),

              const SizedBox(width: 18),

              // =================================================
              // INFORMAÇÕES DO EPI
              // =================================================

              Expanded(
                child: Column(
                  crossAxisAlignment:
                      CrossAxisAlignment.start,
                  children: [

                    Text(
                      epi.nome.isEmpty
                          ? 'EPI'
                          : epi.nome,

                      style: TextStyle(
                        color: textColor,
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                      ),
                    ),

                    if (epi.descricao.isNotEmpty) ...[
                      const SizedBox(height: 7),

                      Text(
                        epi.descricao,

                        style: TextStyle(
                          color:
                              textColor.withOpacity(0.70),
                          fontSize: 13,
                          height: 1.4,
                        ),
                      ),
                    ],
                  ],
                ),
              ),

              // =================================================
              // BLOQUEADO
              // =================================================

              const Padding(
                padding: EdgeInsets.only(
                  left: 10,
                ),
                child: Icon(
                  Icons.lock_outline,
                  size: 18,
                  color: Colors.grey,
                ),
              ),
            ],
          ),
        );
      }).toList(),
    );
  }

  // =========================================================
  // CAMPO
  // =========================================================

  Widget campo(
    String label,
    TextEditingController controller, {
    bool oculto = false,
    bool enabled = true,
    IconData? icon,
    required Color textColor,
    required Color fillColor,
    TextInputType? keyboardType,
    List<TextInputFormatter>? inputFormatters,
  }) {
    return Padding(
      // =====================================================
      // MAIS ESPAÇO ENTRE OS CAMPOS
      // =====================================================

      padding: const EdgeInsets.only(
        bottom: 22,
      ),

      child: TextField(
        controller: controller,
        obscureText: oculto,

        enabled: editando && enabled,

        keyboardType: keyboardType,
        inputFormatters: inputFormatters,

        style: TextStyle(
          color: textColor,
          fontSize: 14,
          fontWeight: FontWeight.w500,
        ),

        decoration: InputDecoration(
          labelText: label,

          prefixIcon: icon != null
              ? Icon(
                  icon,
                  color: const Color(0xFF0F62FE),
                  size: 20,
                )
              : null,

          filled: true,
          fillColor: fillColor,

          // =================================================
          // CAMPO MAIS ALTO
          // =================================================

          contentPadding:
              const EdgeInsets.symmetric(
            vertical: 18,
            horizontal: 16,
          ),

          border: OutlineInputBorder(
            borderRadius:
                BorderRadius.circular(12),
            borderSide: BorderSide.none,
          ),

          disabledBorder: OutlineInputBorder(
            borderRadius:
                BorderRadius.circular(12),
            borderSide: BorderSide.none,
          ),

          enabledBorder: OutlineInputBorder(
            borderRadius:
                BorderRadius.circular(12),
            borderSide: BorderSide.none,
          ),

          focusedBorder: OutlineInputBorder(
            borderRadius:
                BorderRadius.circular(12),
            borderSide: const BorderSide(
              color: Color(0xFF0F62FE),
              width: 2,
            ),
          ),
        ),
      ),
    );
  }

  // =========================================================
  // TÍTULO DA SEÇÃO
  // =========================================================

  Widget _secaoTitulo(
    IconData icon,
    String titulo,
  ) {
    return Row(
      children: [
        Icon(
          icon,
          size: 18,
          color: const Color(0xFF0F62FE),
        ),

        const SizedBox(width: 8),

        Text(
          titulo,
          style: const TextStyle(
            fontSize: 12,
            fontWeight: FontWeight.bold,
            color: Color(0xFF0F62FE),
            letterSpacing: 0.8,
          ),
        ),
      ],
    );
  }

  // =========================================================
  // HEADER
  // =========================================================

  Widget _buildHeader(
    bool isDarkMode,
    Color subTextColor,
  ) {
    return Row(
      children: [

        CircleAvatar(
          radius: 32,

          backgroundColor:
              const Color(0xFF0F62FE),

          child: Text(
            usuarioLogado.nome.isNotEmpty
                ? usuarioLogado.nome[0].toUpperCase()
                : 'F',

            style: const TextStyle(
              color: Colors.white,
              fontSize: 28,
              fontWeight: FontWeight.bold,
            ),
          ),
        ),

        const SizedBox(width: 20),

        Expanded(
          child: Column(
            crossAxisAlignment:
                CrossAxisAlignment.start,
            children: [

              Text(
                'Perfil do Funcionário',

                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.bold,
                  color: isDarkMode
                      ? Colors.white
                      : const Color(0xFF0F62FE),
                ),
              ),

              const SizedBox(height: 5),

              Text(
                'Visualize e gerencie suas informações pessoais',

                style: TextStyle(
                  fontSize: 14,
                  color: subTextColor,
                ),
              ),

              const SizedBox(height: 9),

              Container(
                height: 4,
                width: 45,

                decoration: BoxDecoration(
                  color: const Color(0xFF0F62FE),
                  borderRadius:
                      BorderRadius.circular(2),
                ),
              ),
            ],
          ),
        ),

        Container(
          padding: const EdgeInsets.all(12),

          decoration: BoxDecoration(
            color: isDarkMode
                ? const Color(0xFF2A3B5C)
                : const Color(0xFFEBF3FF),
            shape: BoxShape.circle,
          ),

          child: const Icon(
            Icons.shield_outlined,
            size: 40,
            color: Color(0xFF0F62FE),
          ),
        ),
      ],
    );
  }

  // =========================================================
  // DRAWER
  // =========================================================
// =========================================================
// DRAWER / MENU LATERAL NEXA
// =========================================================

Widget _buildDrawer(BuildContext context) {
  return Drawer(
    backgroundColor: const Color(0xFF071C30),

    child: Stack(
      children: [

        // =====================================================
        // IMAGEM NO CANTO INFERIOR DO MENU
        // =====================================================

        Positioned(
          bottom: 0,
          left: 0,
          right: 0,
          height: 380,

          child: Image.asset(
            "assets/funci.png",

            fit: BoxFit.cover,
            alignment: Alignment.bottomCenter,

            errorBuilder: (
              context,
              error,
              stackTrace,
            ) {
              return Image.asset(
                "assets/funci.webp",

                fit: BoxFit.cover,
                alignment: Alignment.bottomCenter,

                errorBuilder: (
                  context,
                  error,
                  stackTrace,
                ) {
                  return const SizedBox();
                },
              );
            },
          ),
        ),

        // =====================================================
        // GRADIENTE DE FUSÃO SOBRE A IMAGEM
        // =====================================================

        Positioned(
          bottom: 0,
          left: 0,
          right: 0,
          height: 380,

          child: Container(
            decoration: BoxDecoration(
              gradient: LinearGradient(
                begin: Alignment.topCenter,
                end: Alignment.bottomCenter,

                colors: [
                  const Color(0xFF071C30),
                  const Color(0xFF071C30)
                      .withOpacity(0.65),
                ],
              ),
            ),
          ),
        ),

        // =====================================================
        // CONTEÚDO DO DRAWER
        // =====================================================

        SafeArea(
          child: Column(
            crossAxisAlignment:
                CrossAxisAlignment.start,

            children: [

              // =================================================
              // CABEÇALHO
              // =================================================

              Padding(
                padding: const EdgeInsets.symmetric(
                  horizontal: 20,
                  vertical: 20,
                ),

                child: Row(
                  children: [

                    // LOGO NEXA
                    Image.asset(
                      'assets/logo.nexa.png',

                      height: 36,

                      errorBuilder: (
                        context,
                        error,
                        stackTrace,
                      ) {
                        return const Icon(
                          Icons.shield_outlined,
                          color: Colors.white,
                          size: 36,
                        );
                      },
                    ),

                    const SizedBox(width: 14),

                    const Column(
                      crossAxisAlignment:
                          CrossAxisAlignment.start,

                      children: [

                        Text(
                          "NEXA",

                          style: TextStyle(
                            color: Colors.white,
                            fontSize: 22,
                            fontWeight:
                                FontWeight.bold,
                            letterSpacing: 1.2,
                          ),
                        ),

                        Text(
                          "Segurança é prioridade",

                          style: TextStyle(
                            color: Colors.white70,
                            fontSize: 11,
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),

              const SizedBox(height: 10),

              // =================================================
              // SEÇÃO PRINCIPAL
              // =================================================

              const Padding(
                padding: EdgeInsets.symmetric(
                  horizontal: 20,
                  vertical: 8,
                ),

                child: Text(
                  "PRINCIPAL",

                  style: TextStyle(
                    color: Colors.white54,
                    fontSize: 11,
                    fontWeight:
                        FontWeight.bold,
                    letterSpacing: 1.1,
                  ),
                ),
              ),

              // DASHBOARD
              _menuItem(
                icon: Icons.grid_view_rounded,
                texto: "Dashboard",
                ativo: false,

                onTap: () {
                  Navigator.pushReplacement(
                    context,

                    MaterialPageRoute(
                      builder: (_) =>
                          const DashboardPageFun(),
                    ),
                  );
                },
              ),

              // ANÁLISE DE EPI
              _menuItem(
                icon: Icons.videocam_outlined,
                texto: "Análise de EPI",
                ativo: false,

                onTap: () {
                  Navigator.pushReplacement(
                    context,

                    MaterialPageRoute(
                      builder: (_) =>
                          const DashboardCameraPage(),
                    ),
                  );
                },
              ),

              const SizedBox(height: 20),

              // =================================================
              // SEÇÃO CONTA
              // =================================================

              const Padding(
                padding: EdgeInsets.symmetric(
                  horizontal: 20,
                  vertical: 8,
                ),

                child: Text(
                  "CONTA",

                  style: TextStyle(
                    color: Colors.white54,
                    fontSize: 11,
                    fontWeight:
                        FontWeight.bold,
                    letterSpacing: 1.1,
                  ),
                ),
              ),

              // PERFIL
              _menuItem(
                icon: Icons.person_outline,
                texto: "Perfil",
                ativo: true,

                onTap: () {
                  Navigator.pop(context);
                },
              ),

              const Spacer(),

              // =================================================
              // BOTÃO SAIR
              // =================================================

              Padding(
                padding:
                    const EdgeInsets.all(20.0),

                child: OutlinedButton(
                  onPressed: () {
                    Navigator.pushAndRemoveUntil(
                      context,

                      MaterialPageRoute(
                        builder: (_) =>
                            InstitucionalPage(),
                      ),

                      (route) => false,
                    );
                  },

                  style:
                      OutlinedButton.styleFrom(
                    backgroundColor:
                        Colors.black
                            .withOpacity(0.2),

                    side: const BorderSide(
                      color: Colors.white38,
                      width: 1,
                    ),

                    minimumSize:
                        const Size(
                      double.infinity,
                      50,
                    ),

                    shape:
                        RoundedRectangleBorder(
                      borderRadius:
                          BorderRadius.circular(
                        25,
                      ),
                    ),
                  ),

                  child: const Row(
                    mainAxisAlignment:
                        MainAxisAlignment.center,

                    children: [

                      Icon(
                        Icons.logout,
                        color: Colors.white,
                        size: 20,
                      ),

                      SizedBox(width: 10),

                      Text(
                        "Sair do Sistema",

                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 15,
                          fontWeight:
                              FontWeight.bold,
                        ),
                      ),
                    ],
                  ),
                ),
              ),
            ],
          ),
        ),
      ],
    ),
  );
}
  // =========================================================
  // ITEM DO DRAWER
  // =========================================================

  Widget _menuItem({
    required IconData icon,
    required String texto,
    required VoidCallback onTap,
    bool ativo = false,
  }) {
    return Padding(
      padding: const EdgeInsets.symmetric(
        horizontal: 16,
        vertical: 3,
      ),

      child: InkWell(
        borderRadius:
            BorderRadius.circular(12),

        onTap: onTap,

        child: Container(
          padding:
              const EdgeInsets.symmetric(
            vertical: 12,
            horizontal: 16,
          ),

          decoration: BoxDecoration(
            color: ativo
                ? const Color(0xFF0075E3)
                : Colors.transparent,

            borderRadius:
                BorderRadius.circular(12),
          ),

          child: Row(
            children: [

              Icon(
                icon,
                color: Colors.white,
                size: 22,
              ),

              const SizedBox(width: 15),

              Text(
                texto,

                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 15,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

// =============================================================
// FORMATADOR DE TELEFONE
// =============================================================

class _TelefoneInputFormatter
    extends TextInputFormatter {
  @override
  TextEditingValue formatEditUpdate(
    TextEditingValue oldValue,
    TextEditingValue newValue,
  ) {
    String numeros =
        newValue.text.replaceAll(
      RegExp(r'[^0-9]'),
      '',
    );

    if (numeros.length > 11) {
      numeros =
          numeros.substring(0, 11);
    }

    String formatado;

    if (numeros.length <= 2) {
      formatado = numeros;
    } else if (numeros.length <= 7) {
      formatado =
          '(${numeros.substring(0, 2)}) '
          '${numeros.substring(2)}';
    } else {
      formatado =
          '(${numeros.substring(0, 2)}) '
          '${numeros.substring(2, 7)}-'
          '${numeros.substring(7)}';
    }

    return TextEditingValue(
      text: formatado,
      selection: TextSelection.collapsed(
        offset: formatado.length,
      ),
    );
  }
}
