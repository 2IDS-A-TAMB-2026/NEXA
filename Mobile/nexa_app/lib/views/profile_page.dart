import 'package:flutter/material.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import "package:nexa_app/models/user_model.dart";
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

  late TextEditingController nomeController;
  late TextEditingController emailController;
  late TextEditingController telefoneController;
  late TextEditingController cpfController;
  late TextEditingController dataController;
  late TextEditingController uidController;
  late TextEditingController episController;

  late TextEditingController senhaAtualController;
  late TextEditingController novaSenhaController;
  late TextEditingController confirmarSenhaController;

  String mensagem = "";

  @override
  void initState() {
    super.initState();

    nomeController = TextEditingController(text: usuarioLogado.nome);
    emailController = TextEditingController(text: usuarioLogado.email);
    telefoneController = TextEditingController(text: usuarioLogado.telefone);
    cpfController = TextEditingController(text: usuarioLogado.cpf);
    dataController = TextEditingController(text: usuarioLogado.dataNascimento);
    uidController = TextEditingController(text: usuarioLogado.uidRfid);
    episController = TextEditingController(
      text: usuarioLogado.epis.isEmpty
          ? "Nenhum EPI obrigatório cadastrado."
          : usuarioLogado.epis,
    );

    senhaAtualController = TextEditingController(text: "********");
    novaSenhaController = TextEditingController();
    confirmarSenhaController = TextEditingController();
  }

  @override
  Widget build(BuildContext context) {
    final accessibility = context.watch<AccessibilityController>();
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
    final Color cardColor = isDarkMode ? const Color(0xFF1A2B4C) : Colors.white;
    final Color textColor = isDarkMode ? Colors.white : const Color(0xFF161616);
    final Color subTextColor = isDarkMode ? Colors.white70 : Colors.grey;
    final Color fieldFillColor = isDarkMode
        ? const Color(0xFF2A3B5C)
        : const Color(0xFFF4F6FA);

    return Scaffold(
      backgroundColor: backgroundColor,

      ////////////////////////////////////////////////
      /// DRAWER / MENU LATERAL NEXA (ESTILO ATUALIZADO)
      ////////////////////////////////////////////////
      drawer: Drawer(
        backgroundColor: const Color(0xFF071C30),
        child: Stack(
          children: [
            // 🖼️ IMAGEM NO CANTO INFERIOR DO MENU
            Positioned(
              bottom: 0,
              left: 0,
              right: 0,
              height: 380,
              child: Image.asset(
                "assets/funci.png",
                fit: BoxFit.cover,
                alignment: Alignment.bottomCenter,
                errorBuilder: (context, error, stackTrace) {
                  return Image.asset(
                    "assets/funci.webp",
                    fit: BoxFit.cover,
                    alignment: Alignment.bottomCenter,
                    errorBuilder: (context, error, stackTrace) {
                      return const SizedBox();
                    },
                  );
                },
              ),
            ),

            // 🎨 GRADIENTE DE FUSÃO SOBRE A IMAGEM
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
                      const Color(0xFF071C30).withOpacity(0.65),
                    ],
                  ),
                ),
              ),
            ),

            // 📄 CONTEÚDO DO DRAWER
            SafeArea(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // CABEÇALHO: LOGO E TÍTULO NEXA
                  Padding(
                    padding: const EdgeInsets.symmetric(
                      horizontal: 20,
                      vertical: 20,
                    ),
                    child: Row(
                      children: [
                        Image.asset(
                          'assets/logo.nexa.png',
                          height: 36,
                          errorBuilder: (context, error, stackTrace) {
                            return const Icon(
                              Icons.shield_outlined,
                              color: Colors.white,
                              size: 36,
                            );
                          },
                        ),
                        const SizedBox(width: 14),
                        const Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              "NEXA",
                              style: TextStyle(
                                color: Colors.white,
                                fontSize: 22,
                                fontWeight: FontWeight.bold,
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

                  // SEÇÃO PRINCIPAL
                  const Padding(
                    padding: EdgeInsets.symmetric(horizontal: 20, vertical: 8),
                    child: Text(
                      "PRINCIPAL",
                      style: TextStyle(
                        color: Colors.white54,
                        fontSize: 11,
                        fontWeight: FontWeight.bold,
                        letterSpacing: 1.1,
                      ),
                    ),
                  ),

                  _menuItem(
                    icon: Icons.grid_view_rounded,
                    texto: "Dashboard",
                    ativo: false,
                    onTap: () {
                      Navigator.pushReplacement(
                        context,
                        MaterialPageRoute(
                          builder: (_) => const DashboardPageFun(),
                        ),
                      );
                    },
                  ),

                  _menuItem(
                    icon: Icons.videocam_outlined,
                    texto: "Análise de EPI",
                    ativo: false,
                    onTap: () {
                      Navigator.pushReplacement(
                        context,
                        MaterialPageRoute(
                          builder: (_) => const DashboardCamera(),
                        ),
                      );
                    },
                  ),

                  const SizedBox(height: 20),

                  // SEÇÃO CONTA
                  const Padding(
                    padding: EdgeInsets.symmetric(horizontal: 20, vertical: 8),
                    child: Text(
                      "CONTA",
                      style: TextStyle(
                        color: Colors.white54,
                        fontSize: 11,
                        fontWeight: FontWeight.bold,
                        letterSpacing: 1.1,
                      ),
                    ),
                  ),

                  _menuItem(
                    icon: Icons.person_outline,
                    texto: "Perfil",
                    ativo: true,
                    onTap: () {
                      Navigator.pop(context);
                    },
                  ),

                  const Spacer(),

                  // BOTÃO INFERIOR: SAIR DO SISTEMA
                  Padding(
                    padding: const EdgeInsets.all(20.0),
                    child: OutlinedButton(
                      onPressed: () {
                        Navigator.pushAndRemoveUntil(
                          context,
                          MaterialPageRoute(
                            builder: (_) => InstitucionalPage(),
                          ),
                          (route) => false,
                        );
                      },
                      style: OutlinedButton.styleFrom(
                        backgroundColor: Colors.black.withOpacity(0.2),
                        side: const BorderSide(color: Colors.white38, width: 1),
                        minimumSize: const Size(double.infinity, 50),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(25),
                        ),
                      ),
                      child: const Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Icon(Icons.logout, color: Colors.white, size: 20),
                          SizedBox(width: 10),
                          Text(
                            "Sair do Sistema",
                            style: TextStyle(
                              color: Colors.white,
                              fontSize: 15,
                              fontWeight: FontWeight.bold,
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
      ),

      ////////////////////////////////////////////////
      /// APP BAR
      ////////////////////////////////////////////////
      appBar: AppBar(
        elevation: 0,
        backgroundColor: appBarColor,
        iconTheme: const IconThemeData(color: Color(0xFF0F62FE)),
        title: Text(
          "Perfil",
          style: TextStyle(
            color: isDarkMode ? Colors.white : const Color(0xFF0F62FE),
            fontWeight: FontWeight.bold,
          ),
        ),
        actions: [
          IconButton(
            icon: const Icon(Icons.text_increase, color: Color(0xFF0F62FE)),
            onPressed: () {
              context.read<AccessibilityController>().aumentarFonte();
            },
          ),
          IconButton(
            icon: const Icon(Icons.text_decrease, color: Color(0xFF0F62FE)),
            onPressed: () {
              context.read<AccessibilityController>().diminuirFonte();
            },
          ),
          IconButton(
            icon: Icon(
              isDarkMode ? Icons.wb_sunny : Icons.nightlight_round,
              color: const Color(0xFF0F62FE),
            ),
            tooltip: "Alternar Modo Escuro",
            onPressed: () {
              try {
                (context.read<AccessibilityController>() as dynamic)
                    .toggleDarkMode();
              } catch (_) {
                try {
                  (context.read<AccessibilityController>() as dynamic)
                      .alternarTema();
                } catch (_) {}
              }
            },
          ),
          IconButton(
            icon: const Icon(Icons.volume_up, color: Color(0xFF0F62FE)),
            onPressed: () {
              final texto =
                  """
Perfil do Funcionário.
Visualize e gerencie suas informações pessoais.
Informações pessoais: ${nomeController.text}, ${emailController.text}, ${telefoneController.text}.
Data de nascimento: ${dataController.text}, Código: ${uidController.text}.
EPIs obrigatórios: ${episController.text}.
""";
              context.read<AccessibilityController>().lerTexto(texto);
            },
          ),
          const SizedBox(width: 10),
        ],
      ),

      ////////////////////////////////////////////////
      /// BODY CONSTRUÍDO DE ACORDO COM A IMAGEM
      ////////////////////////////////////////////////
      body: Center(
        child: SingleChildScrollView(
          padding: const EdgeInsets.symmetric(vertical: 30, horizontal: 20),
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
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                /// BANNER HEADER DO PERFIL (AVATAR + TÍTULO + CAPACETE)
                Row(
                  crossAxisAlignment: CrossAxisAlignment.center,
                  children: [
                    CircleAvatar(
                      radius: 32,
                      backgroundColor: const Color(0xFF0F62FE),
                      child: const Text(
                        "F",
                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 28,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                    const SizedBox(width: 20),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Perfil do Funcionário",
                            style: TextStyle(
                              fontSize: 24,
                              fontWeight: FontWeight.bold,
                              color: isDarkMode
                                  ? Colors.white
                                  : const Color(0xFF0F62FE),
                            ),
                          ),
                          const SizedBox(height: 4),
                          Text(
                            "Visualize e gerencie suas informações pessoais",
                            style: TextStyle(fontSize: 14, color: subTextColor),
                          ),
                          const SizedBox(height: 8),
                          Container(
                            height: 4,
                            width: 45,
                            decoration: BoxDecoration(
                              color: const Color(0xFF0F62FE),
                              borderRadius: BorderRadius.circular(2),
                            ),
                          ),
                        ],
                      ),
                    ),
                    // Ilustração/Ícone Capacete à direita
                    Opacity(
                      opacity: 0.8,
                      child: Container(
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
                    ),
                  ],
                ),

                const SizedBox(height: 35),

                /// SEÇÃO: INFORMAÇÕES PESSOAIS
                _secaoTitulo(Icons.person_outline, "INFORMAÇÕES PESSOAIS"),
                const SizedBox(height: 12),

                campo(
                  "Nome completo",
                  nomeController,
                  icon: Icons.person_outline,
                  textColor: textColor,
                  fillColor: fieldFillColor,
                ),

                LayoutBuilder(
                  builder: (context, constraints) {
                    bool isMobile = constraints.maxWidth < 600;
                    return isMobile
                        ? Column(
                            children: [
                              campo(
                                "E-mail corporativo",
                                emailController,
                                icon: Icons.email_outlined,
                                textColor: textColor,
                                fillColor: fieldFillColor,
                              ),
                              campo(
                                "Telefone",
                                telefoneController,
                                icon: Icons.phone_outlined,
                                textColor: textColor,
                                fillColor: fieldFillColor,
                              ),
                            ],
                          )
                        : Row(
                            children: [
                              Expanded(
                                child: campo(
                                  "E-mail corporativo",
                                  emailController,
                                  icon: Icons.email_outlined,
                                  textColor: textColor,
                                  fillColor: fieldFillColor,
                                ),
                              ),
                              const SizedBox(width: 15),
                              Expanded(
                                child: campo(
                                  "Telefone",
                                  telefoneController,
                                  icon: Icons.phone_outlined,
                                  textColor: textColor,
                                  fillColor: fieldFillColor,
                                ),
                              ),
                            ],
                          );
                  },
                ),

                LayoutBuilder(
                  builder: (context, constraints) {
                    bool isMobile = constraints.maxWidth < 600;
                    return isMobile
                        ? Column(
                            children: [
                              campo(
                                "Data de Nascimento",
                                dataController,
                                icon: Icons.calendar_today_outlined,
                                enabled: false,
                                textColor: textColor,
                                fillColor: fieldFillColor,
                              ),
                              campo(
                                "Código RFID",
                                uidController,
                                icon: Icons.badge_outlined,
                                enabled: false,
                                textColor: textColor,
                                fillColor: fieldFillColor,
                              ),
                            ],
                          )
                        : Row(
                            children: [
                              Expanded(
                                child: campo(
                                  "Data de Nascimento",
                                  dataController,
                                  icon: Icons.calendar_today_outlined,
                                  enabled: false,
                                  textColor: textColor,
                                  fillColor: fieldFillColor,
                                ),
                              ),
                              const SizedBox(width: 15),
                              Expanded(
                                child: campo(
                                  "Código RFID",
                                  uidController,
                                  icon: Icons.badge_outlined,
                                  enabled: false,
                                  textColor: textColor,
                                  fillColor: fieldFillColor,
                                ),
                              ),
                            ],
                          );
                  },
                ),

                const SizedBox(height: 25),

                /// SEÇÃO: EPIS OBRIGATÓRIOS
                _secaoTitulo(Icons.shield_outlined, "EPIS OBRIGATÓRIOS"),
                const SizedBox(height: 12),
                campo(
                  "EPIs",
                  episController,
                  icon: Icons.shield_outlined,
                  enabled: false,
                  textColor: textColor,
                  fillColor: fieldFillColor,
                ),

                const SizedBox(height: 25),

                /// SEÇÃO: SEGURANÇA
                _secaoTitulo(Icons.lock_outline, "SEGURANÇA"),
                const SizedBox(height: 12),

                campo(
                  "Senha atual",
                  senhaAtualController,
                  icon: Icons.lock_outline,
                  oculto: !alterarSenha,
                  enabled: editando,
                  subtitulo: alterarSenha ? null : "********",
                  textColor: textColor,
                  fillColor: fieldFillColor,
                ),

                if (alterarSenha) ...[
                  campo(
                    "Nova senha",
                    novaSenhaController,
                    icon: Icons.lock_outline,
                    oculto: true,
                    textColor: textColor,
                    fillColor: fieldFillColor,
                  ),
                  campo(
                    "Confirmar senha",
                    confirmarSenhaController,
                    icon: Icons.lock_outline,
                    oculto: true,
                    textColor: textColor,
                    fillColor: fieldFillColor,
                  ),
                ],

                if (mensagem.isNotEmpty)
                  Padding(
                    padding: const EdgeInsets.only(top: 8.0),
                    child: Text(
                      mensagem,
                      style: const TextStyle(
                        color: Colors.red,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),

                const SizedBox(height: 35),

                /// BOTÃO DE AÇÃO
                Center(
                  child: ElevatedButton.icon(
                    icon: Icon(
                      editando ? Icons.save : Icons.edit_note_rounded,
                      size: 20,
                    ),
                    label: Text(
                      editando ? "Salvar Alterações" : "Editar Campos",
                      style: const TextStyle(
                        fontSize: 15,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFF0F62FE),
                      foregroundColor: Colors.white,
                      padding: const EdgeInsets.symmetric(
                        horizontal: 36,
                        vertical: 16,
                      ),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(25),
                      ),
                      elevation: 0,
                    ),
                    onPressed: () {
                      setState(() {
                        if (editando) {
                          if (alterarSenha) {
                            if (senhaAtualController.text !=
                                usuarioLogado.senha) {
                              mensagem = "Senha atual incorreta.";
                              return;
                            }
                            if (novaSenhaController.text.isEmpty) {
                              mensagem = "Digite a nova senha.";
                              return;
                            }
                            if (novaSenhaController.text !=
                                confirmarSenhaController.text) {
                              mensagem = "Senhas não coincidem.";
                              return;
                            }
                            usuarioLogado.senha = novaSenhaController.text;
                          }

                          usuarioLogado.nome = nomeController.text;
                          usuarioLogado.email = emailController.text;
                          usuarioLogado.telefone = telefoneController.text;

                          mensagem = "";
                          alterarSenha = false;
                        } else {
                          alterarSenha = true;
                        }

                        editando = !editando;
                      });
                    },
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  /// TÍTULO DAS SEÇÕES
  Widget _secaoTitulo(IconData icon, String titulo) {
    return Row(
      children: [
        Icon(icon, size: 18, color: const Color(0xFF0F62FE)),
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

  /// DRAWER MENU ITEM ATUALIZADO
  Widget _menuItem({
    required IconData icon,
    required String texto,
    required VoidCallback onTap,
    bool ativo = false,
  }) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 3),
      child: InkWell(
        borderRadius: BorderRadius.circular(12),
        onTap: onTap,
        child: Container(
          padding: const EdgeInsets.symmetric(vertical: 12, horizontal: 16),
          decoration: BoxDecoration(
            color: ativo ? const Color(0xFF0075E3) : Colors.transparent,
            borderRadius: BorderRadius.circular(12),
          ),
          child: Row(
            children: [
              Icon(icon, color: Colors.white, size: 22),
              const SizedBox(width: 15),
              Text(
                texto,
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 15,
                  fontWeight: FontWeight.w500,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  /// CAMPO ESTILIZADO IGUAL AO DA IMAGEM
  Widget campo(
    String label,
    TextEditingController controller, {
    bool oculto = false,
    bool enabled = true,
    IconData? icon,
    String? subtitulo,
    required Color textColor,
    required Color fillColor,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: TextField(
        controller: controller,
        obscureText: oculto,
        enabled: editando && enabled,
        style: TextStyle(
          color: textColor,
          fontSize: 14,
          fontWeight: FontWeight.w500,
        ),
        decoration: InputDecoration(
          prefixIcon: icon != null
              ? Icon(icon, color: const Color(0xFF0F62FE), size: 20)
              : null,
          filled: true,
          fillColor: fillColor,
          contentPadding: const EdgeInsets.symmetric(
            vertical: 16,
            horizontal: 16,
          ),
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
            borderSide: BorderSide.none,
          ),
          disabledBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
            borderSide: BorderSide.none,
          ),
        ),
      ),
    );
  }
}
