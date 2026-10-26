import 'package:flutter/material.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import 'package:nexa_app/models/dashboard_fun_model.dart';
import 'package:nexa_app/models/user_model.dart';
import 'package:nexa_app/services/api_service.dart';
import 'package:nexa_app/views/dashboard_cameras.dart';
import 'package:nexa_app/views/institucional_page.dart';
import 'package:nexa_app/views/profile_page.dart';
import 'package:nexa_app/views/login_page.dart';
import 'package:provider/provider.dart';

class DashboardPageFun extends StatefulWidget {
  const DashboardPageFun({super.key});

  @override
  State<DashboardPageFun> createState() => _DashboardPageFunState();
}

class _DashboardPageFunState extends State<DashboardPageFun> {
  DashboardFunModel? dashboard;

  bool carregando = true;
  String? erro;

  late DateTime mesAtual;

  @override
  void initState() {
    super.initState();
    mesAtual = DateTime(2026, 10);
    carregarDashboard();
  }

  Future<void> carregarDashboard() async {
    if (!mounted) return;

    setState(() {
      carregando = true;
      erro = null;
    });

    try {
      final dados = await ApiService.buscarDashboardFuncionario(
        usuarioLogado.cpf,
      );

      if (!mounted) return;

      setState(() {
        dashboard = dados;
        carregando = false;
      });
    } catch (e) {
      if (!mounted) return;

      setState(() {
        carregando = false;
        erro = e.toString().replaceFirst('Exception: ', '');
      });
    }
  }

  bool verificarDarkMode(AccessibilityController accessibility) {
    try {
      return (accessibility as dynamic).darkMode ??
          (accessibility as dynamic).isDarkMode ??
          false;
    } catch (_) {
      return false;
    }
  }

  void mudarMes(int delta) {
    setState(() {
      mesAtual = DateTime(mesAtual.year, mesAtual.month + delta, 1);
    });
  }

  @override
  Widget build(BuildContext context) {
    final accessibility = context.watch<AccessibilityController>();
    final bool isDarkMode = verificarDarkMode(accessibility);

    final Color backgroundColor = isDarkMode
        ? const Color(0xFF000000)
        : const Color(0xFFF3F5F9);

    final Color appBarColor = isDarkMode
        ? const Color(0xFF1A2B4C)
        : Colors.white;

    final Color textColor = isDarkMode ? Colors.white : const Color(0xFF161616);
    final Color subTextColor = isDarkMode ? Colors.white70 : Colors.grey;

    final String nome = dashboard?.funcionario.nome.isNotEmpty == true
        ? dashboard!.funcionario.nome
        : usuarioLogado.nome.isNotEmpty
        ? usuarioLogado.nome
        : "Funcionário";

    final String empresa = dashboard?.funcionario.empresa.isNotEmpty == true
        ? dashboard!.funcionario.empresa
        : usuarioLogado.empresa.isNotEmpty
        ? usuarioLogado.empresa
        : "NEXA SOLUÇÕES";

    return Scaffold(
      backgroundColor: backgroundColor,
      drawer: _buildDrawer(context),
      appBar: AppBar(
        elevation: 0,
        backgroundColor: appBarColor,
        iconTheme: const IconThemeData(color: Color(0xFF0F62FE)),
        title: const Align(
          alignment: Alignment.centerLeft,
          child: Text(
            "Bem-vindo,",
            maxLines: 1,
            softWrap: false,
            overflow: TextOverflow.ellipsis,
            textScaler: TextScaler.linear(1.0),
            style: TextStyle(
              color: Color(0xFF0F62FE),
              fontSize: 15,
              fontWeight: FontWeight.bold,
            ),
          ),
        ),
        actions: [
          PopupMenuButton<String>(
            icon: const Icon(Icons.settings_outlined, color: Color(0xFF0F62FE)),
            tooltip: "Acessibilidade",
            onSelected: (value) {
              final accessibility = context.read<AccessibilityController>();
              switch (value) {
                case 'aumentar':
                  accessibility.aumentarFonte();
                  break;
                case 'diminuir':
                  accessibility.diminuirFonte();
                  break;
                case 'escuro':
                  try {
                    (accessibility as dynamic).toggleDarkMode();
                  } catch (_) {
                    try {
                      (accessibility as dynamic).alternarTema();
                    } catch (_) {}
                  }
                  break;
                case 'contraste':
                  try {
                    (accessibility as dynamic).toggleHighContrast();
                  } catch (_) {
                    try {
                      (accessibility as dynamic).alternarAltoContraste();
                    } catch (_) {}
                  }
                  break;
                case 'ler':
                  final texto =
                      """
                  Bem-vindo $nome.
                  Empresa $empresa.
                  Dashboard do funcionário.
                  Calendário de atividades e dicas de segurança ativas.
                  """;
                  accessibility.lerTexto(texto);
                  break;
              }
            },
            itemBuilder: (context) => [
              const PopupMenuItem<String>(
                enabled: false,
                child: Text(
                  "Acessibilidade",
                  style: TextStyle(
                    fontWeight: FontWeight.bold,
                    color: Color(0xFF0F62FE),
                  ),
                ),
              ),
              const PopupMenuDivider(),
              const PopupMenuItem<String>(
                value: 'aumentar',
                child: Row(
                  children: [
                    Icon(Icons.text_increase, color: Color(0xFF0F62FE)),
                    SizedBox(width: 12),
                    Text("Aumentar fonte"),
                  ],
                ),
              ),
              const PopupMenuItem<String>(
                value: 'diminuir',
                child: Row(
                  children: [
                    Icon(Icons.text_decrease, color: Color(0xFF0F62FE)),
                    SizedBox(width: 12),
                    Text("Diminuir fonte"),
                  ],
                ),
              ),
              const PopupMenuItem<String>(
                value: 'escuro',
                child: Row(
                  children: [
                    Icon(Icons.dark_mode_outlined, color: Color(0xFF0F62FE)),
                    SizedBox(width: 12),
                    Text("Modo escuro"),
                  ],
                ),
              ),
              const PopupMenuItem<String>(
                value: 'ler',
                child: Row(
                  children: [
                    Icon(Icons.volume_up, color: Color(0xFF0F62FE)),
                    SizedBox(width: 12),
                    Text("Ler página"),
                  ],
                ),
              ),
            ],
          ),
          LayoutBuilder(
            builder: (context, constraints) {
              final largura = MediaQuery.sizeOf(context).width;
              final double larguraPerfil = largura < 320
                  ? 76
                  : largura < 380
                  ? 105
                  : largura < 500
                  ? 145
                  : 190;

              return SizedBox(
                width: larguraPerfil,
                child: InkWell(
                  borderRadius: BorderRadius.circular(30),
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (_) => const DashboardPageFun(),
                      ),
                    );
                  },
                  child: Row(
                    children: [
                      CircleAvatar(
                        radius: 18,
                        backgroundColor: const Color(0xFF0F62FE),
                        child: Text(
                          nome.isNotEmpty ? nome[0].toUpperCase() : "F",
                          maxLines: 1,
                          textScaler: const TextScaler.linear(1.0),
                          style: const TextStyle(
                            color: Colors.white,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ),
                      const SizedBox(width: 7),
                      Expanded(
                        child: Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              nome,
                              maxLines: 1,
                              softWrap: false,
                              overflow: TextOverflow.ellipsis,
                              textScaler: const TextScaler.linear(1.0),
                              style: TextStyle(
                                color: textColor,
                                fontSize: 12,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                            Text(
                              empresa,
                              maxLines: 1,
                              softWrap: false,
                              overflow: TextOverflow.ellipsis,
                              textScaler: const TextScaler.linear(1.0),
                              style: TextStyle(
                                color: subTextColor,
                                fontSize: 9,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
              );
            },
          ),
          const SizedBox(width: 15),
        ],
      ),
      body: _buildBody(context, isDarkMode),
    );
  }

  Widget _buildBody(BuildContext context, bool isDarkMode) {
    if (carregando) {
      return const Center(
        child: CircularProgressIndicator(color: Color(0xFF0F62FE)),
      );
    }

    if (erro != null) {
      return _buildErro();
    }

    if (dashboard == null) {
      return _buildErro(mensagem: "Nenhum dado foi encontrado.");
    }

    return LayoutBuilder(
      builder: (context, constraints) {
        final bool isDesktop = constraints.maxWidth > 900;

        return RefreshIndicator(
          onRefresh: carregarDashboard,
          child: SingleChildScrollView(
            physics: const AlwaysScrollableScrollPhysics(),
            padding: const EdgeInsets.all(24),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const SizedBox(height: 12),
                isDesktop
                    ? Row(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Expanded(
                            flex: 3,
                            child: CalendarioEPIInterativo(
                              historico: dashboard!.ocorrencias.historico,
                              mesAtual: mesAtual,
                              onMudarMes: mudarMes,
                              isDarkMode: isDarkMode,
                            ),
                          ),
                          const SizedBox(width: 24),
                          const Expanded(
                            flex: 2,
                            child: _DicasSegurancaSecao(),
                          ),
                        ],
                      )
                    : Column(
                        children: [
                          CalendarioEPIInterativo(
                            historico: dashboard!.ocorrencias.historico,
                            mesAtual: mesAtual,
                            onMudarMes: mudarMes,
                            isDarkMode: isDarkMode,
                          ),
                          const SizedBox(height: 24),
                          const _DicasSegurancaSecao(),
                        ],
                      ),
                const SizedBox(height: 24),
              ],
            ),
          ),
        );
      },
    );
  }

  Widget _buildErro({String? mensagem}) {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(24),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            const Icon(Icons.error_outline, color: Colors.red, size: 52),
            const SizedBox(height: 16),
            const Text(
              "Não foi possível carregar o Dashboard",
              textAlign: TextAlign.center,
              style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 10),
            Text(
              mensagem ?? erro ?? "Verifique a conexão com a API.",
              textAlign: TextAlign.center,
              style: const TextStyle(color: Colors.grey),
            ),
            const SizedBox(height: 22),
            ElevatedButton.icon(
              onPressed: carregarDashboard,
              icon: const Icon(Icons.refresh),
              label: const Text("Tentar novamente"),
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFF0F62FE),
                foregroundColor: Colors.white,
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildDrawer(BuildContext context) {
    return Drawer(
      backgroundColor: const Color(0xFF071C30),
      child: Stack(
        children: [
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
          SafeArea(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
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
                      const Expanded(
                        child: Column(
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
                              maxLines: 2,
                              overflow: TextOverflow.ellipsis,
                              style: TextStyle(
                                color: Colors.white70,
                                fontSize: 11,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(height: 10),
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
                  isSelected: true,
                  onTap: () => Navigator.pop(context),
                ),
                _menuItem(
                  icon: Icons.videocam_outlined,
                  texto: "Análise de EPI",
                  isSelected: false,
                  onTap: () {
                    Navigator.pop(context);
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (_) => const DashboardCameraPage(),
                      ),
                    );
                  },
                ),
                const SizedBox(height: 15),
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
                  isSelected: false,
                  onTap: () {
                    Navigator.pop(context);
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (_) => const DashboardPageFun(),
                      ),
                    );
                  },
                ),
                const Spacer(),
                Padding(
                  padding: const EdgeInsets.all(20),
                  child: SizedBox(
                    width: double.infinity,
                    child: OutlinedButton.icon(
                      onPressed: () {
                        // Navegação segura usando pushAndRemoveUntil para limpar o histórico e voltar ao login
                        Navigator.pushAndRemoveUntil(
                          context,
                          MaterialPageRoute(
                            builder: (_) =>
                                LoginPage(onLogin: () {}, onVoltar: () {}),
                          ),
                          (route) => false,
                        );
                      },
                      icon: const Icon(Icons.logout, color: Colors.white),
                      label: const Text(
                        "Sair do Sistema",
                        style: TextStyle(color: Colors.white),
                      ),
                      style: OutlinedButton.styleFrom(
                        side: const BorderSide(color: Colors.white38),
                        padding: const EdgeInsets.symmetric(vertical: 14),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(30),
                        ),
                      ),
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

  Widget _menuItem({
    required IconData icon,
    required String texto,
    required bool isSelected,
    required VoidCallback onTap,
  }) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
      decoration: BoxDecoration(
        color: isSelected ? const Color(0xFF0F62FE) : Colors.transparent,
        borderRadius: BorderRadius.circular(10),
      ),
      child: ListTile(
        leading: Icon(icon, color: Colors.white),
        title: Text(texto, style: const TextStyle(color: Colors.white)),
        onTap: onTap,
      ),
    );
  }
}

// =========================================================
// WIDGET DO CALENDÁRIO INTERATIVO
// =========================================================

class CalendarioEPIInterativo extends StatelessWidget {
  final List<dynamic> historico;
  final DateTime mesAtual;
  final Function(int) onMudarMes;
  final bool isDarkMode;

  const CalendarioEPIInterativo({
    super.key,
    required this.historico,
    required this.mesAtual,
    required this.onMudarMes,
    required this.isDarkMode,
  });

  String _obterNomeMes(int mes) {
    const meses = [
      "JAN",
      "FEV",
      "MAR",
      "ABR",
      "MAI",
      "JUN",
      "JUL",
      "AGO",
      "SET",
      "OUT",
      "NOV",
      "DEZ",
    ];
    return meses[mes - 1];
  }

  int _diasNoMes(DateTime data) {
    return DateTime(data.year, data.month + 1, 0).day;
  }

  @override
  Widget build(BuildContext context) {
    final Color cardColor = isDarkMode ? const Color(0xFF1A2B4C) : Colors.white;
    final Color textColor = isDarkMode ? Colors.white : const Color(0xFF161616);
    final Color subTextColor = isDarkMode ? Colors.white70 : Colors.grey;
    final Color dayBoxColor = isDarkMode
        ? const Color(0xFF2A3B5C)
        : const Color(0xFFF4F6FA);

    final int totalDias = _diasNoMes(mesAtual);

    return Container(
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius: BorderRadius.circular(24),
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
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: const Color(0xFF0F62FE),
                  borderRadius: BorderRadius.circular(14),
                ),
                child: const Icon(Icons.calendar_today, color: Colors.white),
              ),
              const SizedBox(width: 16),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      "Calendário",
                      style: TextStyle(
                        color: textColor,
                        fontSize: 20,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                    const SizedBox(height: 2),
                    Text(
                      "Visualize os dias e suas atividades",
                      style: TextStyle(color: subTextColor, fontSize: 13),
                    ),
                  ],
                ),
              ),
            ],
          ),
          const SizedBox(height: 24),
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              IconButton(
                onPressed: () => onMudarMes(-1),
                icon: const Icon(Icons.chevron_left, color: Color(0xFF0F62FE)),
              ),
              Column(
                children: [
                  Text(
                    _obterNomeMes(mesAtual.month),
                    style: const TextStyle(
                      color: Color(0xFF0F62FE),
                      fontWeight: FontWeight.bold,
                      fontSize: 16,
                    ),
                  ),
                  Text(
                    "${mesAtual.year}",
                    style: TextStyle(color: subTextColor, fontSize: 11),
                  ),
                ],
              ),
              IconButton(
                onPressed: () => onMudarMes(1),
                icon: const Icon(Icons.chevron_right, color: Color(0xFF0F62FE)),
              ),
            ],
          ),
          const SizedBox(height: 20),
          GridView.builder(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
              crossAxisCount: 7,
              crossAxisSpacing: 8,
              mainAxisSpacing: 8,
              childAspectRatio: 1.0,
            ),
            itemCount: totalDias,
            itemBuilder: (context, index) {
              final dia = index + 1;

              final String diaStr = dia.toString().padLeft(2, '0');
              final String mesStr = mesAtual.month.toString().padLeft(2, '0');
              final String dataFormatada = "${mesAtual.year}-$mesStr-$diaStr";

              final ocorrenciasDoDia = historico.where((h) {
                final String dataAnalise = (h.dataAnalise ?? '').toString();
                return dataAnalise.contains(dataFormatada) ||
                    dataAnalise == "$diaStr/$mesStr/${mesAtual.year}";
              }).toList();

              Color dotColor = Colors.grey.shade400;
              bool temErro = false;
              bool temCorreto = false;

              if (ocorrenciasDoDia.isNotEmpty) {
                for (var o in ocorrenciasDoDia) {
                  final status = (o.status ?? '').toString().toLowerCase();
                  if (status.contains('regular') ||
                      status.contains('correto') ||
                      status.contains('conforme')) {
                    temCorreto = true;
                  } else {
                    temErro = true;
                  }
                }

                if (temErro) {
                  dotColor = Colors.red;
                } else if (temCorreto) {
                  dotColor = Colors.green;
                }
              }

              return InkWell(
                borderRadius: BorderRadius.circular(12),
                onTap: () {
                  _mostrarDetalhesDia(
                    context,
                    dia,
                    mesAtual.month,
                    mesAtual.year,
                    ocorrenciasDoDia,
                    isDarkMode,
                  );
                },
                child: Container(
                  decoration: BoxDecoration(
                    color: dayBoxColor,
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Text(
                        "$dia",
                        style: TextStyle(
                          color: textColor,
                          fontWeight: FontWeight.bold,
                          fontSize: 13,
                        ),
                      ),
                      const SizedBox(height: 4),
                      Container(
                        width: 6,
                        height: 6,
                        decoration: BoxDecoration(
                          color: dotColor,
                          shape: BoxShape.circle,
                        ),
                      ),
                    ],
                  ),
                ),
              );
            },
          ),
          const SizedBox(height: 24),
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              _legendaItem(Colors.green, "Correto", subTextColor),
              const SizedBox(width: 16),
              _legendaItem(Colors.red, "Erro", subTextColor),
              const SizedBox(width: 16),
              _legendaItem(Colors.grey.shade400, "Sem registro", subTextColor),
            ],
          ),
        ],
      ),
    );
  }

  // =========================================================
  // MODAL DE DETALHAMENTO
  // =========================================================
  void _mostrarDetalhesDia(
    BuildContext context,
    int dia,
    int mes,
    int ano,
    List<dynamic> ocorrencias,
    bool isDarkMode,
  ) {
    showDialog(
      context: context,
      builder: (context) {
        return Dialog(
          backgroundColor: isDarkMode ? const Color(0xFF1A2B4C) : Colors.white,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(24),
          ),
          child: Container(
            constraints: const BoxConstraints(maxWidth: 550, maxHeight: 650),
            padding: const EdgeInsets.all(24),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  children: [
                    Container(
                      padding: const EdgeInsets.all(12),
                      decoration: BoxDecoration(
                        color: const Color(0xFF0F62FE).withOpacity(0.12),
                        borderRadius: BorderRadius.circular(14),
                      ),
                      child: const Icon(
                        Icons.fact_check_outlined,
                        color: Color(0xFF0F62FE),
                        size: 26,
                      ),
                    ),
                    const SizedBox(width: 16),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Detalhamento das ocorrências",
                            style: TextStyle(
                              color: isDarkMode
                                  ? Colors.white
                                  : const Color(0xFF161616),
                              fontSize: 18,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                          const SizedBox(height: 2),
                          Text(
                            "${ocorrencias.length} ocorrência(s) encontrada(s)",
                            style: TextStyle(
                              color: isDarkMode ? Colors.white70 : Colors.grey,
                              fontSize: 13,
                            ),
                          ),
                        ],
                      ),
                    ),
                    IconButton(
                      icon: Icon(
                        Icons.close,
                        color: isDarkMode ? Colors.white70 : Colors.grey,
                      ),
                      onPressed: () => Navigator.pop(context),
                    ),
                  ],
                ),
                const SizedBox(height: 16),
                const Divider(),
                const SizedBox(height: 16),
                Expanded(
                  child: ocorrencias.isEmpty
                      ? Center(
                          child: Text(
                            "Nenhum registro ou ocorrência neste dia.",
                            style: TextStyle(
                              color: isDarkMode ? Colors.white70 : Colors.grey,
                              fontSize: 14,
                            ),
                          ),
                        )
                      : ListView.builder(
                          shrinkWrap: true,
                          itemCount: ocorrencias.length,
                          itemBuilder: (context, index) {
                            final oc = ocorrencias[index];
                            final status = (oc.status ?? 'Conforme').toString();
                            final hora = (oc.horaAnalise ?? '').toString();
                            final camera = (oc.identificadorCamera ?? '')
                                .toString();
                            final ausentes = (oc.episAusente ?? '').toString();

                            final String statusLower = status.toLowerCase();
                            final bool ehRegular =
                                (statusLower.contains("regular") &&
                                    !statusLower.contains("irregular")) ||
                                statusLower.contains("correto") ||
                                statusLower.contains("conforme");

                            final String dataFormatada =
                                "$ano-${mes.toString().padLeft(2, '0')}-${dia.toString().padLeft(2, '0')}";

                            final bool temAusentes =
                                ausentes.trim().isNotEmpty &&
                                ausentes.trim().toLowerCase() != "nenhum";

                            return Container(
                              margin: const EdgeInsets.only(bottom: 16),
                              padding: const EdgeInsets.all(20),
                              decoration: BoxDecoration(
                                color: isDarkMode
                                    ? const Color(0xFF2A3B5C)
                                    : const Color(0xFFF8FAFC),
                                borderRadius: BorderRadius.circular(20),
                                border: Border.all(
                                  color: isDarkMode
                                      ? Colors.white10
                                      : Colors.grey.shade200,
                                ),
                              ),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Row(
                                    mainAxisAlignment:
                                        MainAxisAlignment.spaceBetween,
                                    children: [
                                      Text(
                                        "Ocorrência ${index + 1}",
                                        style: TextStyle(
                                          color: isDarkMode
                                              ? Colors.white
                                              : const Color(0xFF161616),
                                          fontSize: 16,
                                          fontWeight: FontWeight.bold,
                                        ),
                                      ),
                                      Container(
                                        padding: const EdgeInsets.symmetric(
                                          horizontal: 12,
                                          vertical: 6,
                                        ),
                                        decoration: BoxDecoration(
                                          color: ehRegular
                                              ? Colors.green.withOpacity(0.12)
                                              : Colors.red.withOpacity(0.12),
                                          borderRadius: BorderRadius.circular(
                                            20,
                                          ),
                                        ),
                                        child: Row(
                                          mainAxisSize: MainAxisSize.min,
                                          children: [
                                            Icon(
                                              ehRegular
                                                  ? Icons.check_circle_outline
                                                  : Icons.error_outline,
                                              color: ehRegular
                                                  ? Colors.green
                                                  : Colors.red,
                                              size: 16,
                                            ),
                                            const SizedBox(width: 6),
                                            Text(
                                              status,
                                              style: TextStyle(
                                                color: ehRegular
                                                    ? Colors.green
                                                    : Colors.red,
                                                fontWeight: FontWeight.bold,
                                                fontSize: 12,
                                              ),
                                            ),
                                          ],
                                        ),
                                      ),
                                    ],
                                  ),
                                  const SizedBox(height: 16),
                                  _buildDetalheItemModal(
                                    icon: Icons.calendar_today_outlined,
                                    label: "Data",
                                    value: dataFormatada,
                                    isDarkMode: isDarkMode,
                                  ),
                                  const SizedBox(height: 10),
                                  _buildDetalheItemModal(
                                    icon: Icons.access_time_outlined,
                                    label: "Horário",
                                    value: hora.isNotEmpty
                                        ? hora
                                        : "Não informado",
                                    isDarkMode: isDarkMode,
                                  ),
                                  const SizedBox(height: 10),
                                  _buildDetalheItemModal(
                                    icon: Icons.videocam_outlined,
                                    label: "Câmera",
                                    value: camera.isNotEmpty
                                        ? camera
                                        : "Não informado",
                                    isDarkMode: isDarkMode,
                                  ),
                                  if (temAusentes) ...[
                                    const SizedBox(height: 16),
                                    const Text(
                                      "EPIs ausentes",
                                      style: TextStyle(
                                        color: Colors.red,
                                        fontWeight: FontWeight.bold,
                                        fontSize: 14,
                                      ),
                                    ),
                                    const SizedBox(height: 8),
                                    Container(
                                      width: double.infinity,
                                      padding: const EdgeInsets.all(14),
                                      decoration: BoxDecoration(
                                        color: Colors.red.withOpacity(0.08),
                                        borderRadius: BorderRadius.circular(12),
                                      ),
                                      child: Text(
                                        ausentes,
                                        style: const TextStyle(
                                          color: Colors.red,
                                          fontSize: 14,
                                          fontWeight: FontWeight.w500,
                                        ),
                                      ),
                                    ),
                                  ],
                                ],
                              ),
                            );
                          },
                        ),
                ),
                const SizedBox(height: 16),
                SizedBox(
                  width: double.infinity,
                  child: ElevatedButton(
                    onPressed: () => Navigator.pop(context),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFF0F62FE),
                      foregroundColor: Colors.white,
                      padding: const EdgeInsets.symmetric(vertical: 16),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(30),
                      ),
                      elevation: 0,
                    ),
                    child: const Text(
                      "Fechar",
                      style: TextStyle(
                        fontSize: 16,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                ),
              ],
            ),
          ),
        );
      },
    );
  }

  Widget _buildDetalheItemModal({
    required IconData icon,
    required String label,
    required String value,
    required bool isDarkMode,
  }) {
    final Color itemBoxColor = isDarkMode
        ? const Color(0xFF1A2B4C)
        : Colors.white;
    final Color textColor = isDarkMode ? Colors.white : const Color(0xFF161616);
    final Color subTextColor = isDarkMode ? Colors.white70 : Colors.grey;

    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 10),
      decoration: BoxDecoration(
        color: itemBoxColor,
        borderRadius: BorderRadius.circular(12),
      ),
      child: Row(
        children: [
          Icon(icon, color: const Color(0xFF0F62FE), size: 20),
          const SizedBox(width: 12),
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(label, style: TextStyle(color: subTextColor, fontSize: 11)),
              const SizedBox(height: 2),
              Text(
                value,
                style: TextStyle(
                  color: textColor,
                  fontSize: 13,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _legendaItem(Color cor, String texto, Color textColor) {
    return Row(
      children: [
        Container(
          width: 8,
          height: 8,
          decoration: BoxDecoration(color: cor, shape: BoxShape.circle),
        ),
        const SizedBox(width: 6),
        Text(texto, style: TextStyle(color: textColor, fontSize: 11)),
      ],
    );
  }
}

// =========================================================
// WIDGET DAS DICAS DE SEGURANÇA
// =========================================================

class _DicasSegurancaSecao extends StatelessWidget {
  const _DicasSegurancaSecao();

  @override
  Widget build(BuildContext context) {
    final accessibility = context.watch<AccessibilityController>();
    final bool isDarkMode = (accessibility as dynamic).darkMode ?? false;

    final Color cardColor = isDarkMode ? const Color(0xFF1A2B4C) : Colors.white;
    final Color textColor = isDarkMode ? Colors.white : const Color(0xFF161616);
    final Color itemBoxColor = isDarkMode
        ? const Color(0xFF2A3B5C)
        : const Color(0xFFF4F6FA);

    return Container(
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius: BorderRadius.circular(24),
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
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: const Color(0xFF0F62FE),
                  borderRadius: BorderRadius.circular(14),
                ),
                child: const Icon(Icons.shield_outlined, color: Colors.white),
              ),
              const SizedBox(width: 16),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      "Dicas de\nSegurança",
                      style: TextStyle(
                        color: textColor,
                        fontSize: 20,
                        fontWeight: FontWeight.bold,
                        height: 1.2,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
          const SizedBox(height: 24),
          _dicaItem(
            Icons.security,
            "Use sempre EPIs completos",
            itemBoxColor,
            textColor,
          ),
          const SizedBox(height: 12),
          _dicaItem(
            Icons.check_circle_outline,
            "Verifique seus equipamentos",
            itemBoxColor,
            textColor,
          ),
          const SizedBox(height: 12),
          _dicaItem(
            Icons.warning_amber_rounded,
            "Atenção às áreas de risco",
            itemBoxColor,
            textColor,
          ),
          const SizedBox(height: 12),
          _dicaItem(
            Icons.description_outlined,
            "Siga as normas da empresa",
            itemBoxColor,
            textColor,
          ),
        ],
      ),
    );
  }

  Widget _dicaItem(
    IconData icon,
    String texto,
    Color itemBoxColor,
    Color textColor,
  ) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: itemBoxColor,
        borderRadius: BorderRadius.circular(16),
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(10),
            decoration: BoxDecoration(
              color: const Color(0xFF0F62FE).withOpacity(0.12),
              borderRadius: BorderRadius.circular(12),
            ),
            child: Icon(icon, color: const Color(0xFF0F62FE), size: 22),
          ),
          const SizedBox(width: 14),
          Expanded(
            child: Text(
              texto,
              style: TextStyle(
                color: textColor,
                fontWeight: FontWeight.w600,
                fontSize: 13,
              ),
            ),
          ),
        ],
      ),
    );
  }
}
