import 'package:flutter/material.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import 'package:nexa_app/views/dashboard_cameras.dart';
import 'package:nexa_app/views/institucional_page.dart';
import 'package:nexa_app/views/login_page.dart';
import 'package:nexa_app/views/profile_page.dart';
import 'package:provider/provider.dart';

class DashboardPageFun extends StatelessWidget {
  const DashboardPageFun({super.key});

  @override
  Widget build(BuildContext context) {
    final accessibility = context.watch<AccessibilityController>();
    
    // Tratamento seguro para identificar se o modo escuro está ativo
    // (caso a propriedade no seu controller tenha outro nome, ajuste aqui se necessário)
    bool isDarkMode = false;
    try {
      isDarkMode = (accessibility as dynamic).darkMode ?? (accessibility as dynamic).isDarkMode ?? false;
    } catch (_) {
      isDarkMode = false;
    }

    final Color backgroundColor = isDarkMode ? const Color(0xFF000000) : const Color(0xFFF3F5F9);
    final Color appBarColor = isDarkMode ? const Color(0xFF1A2B4C) : Colors.white;
    final Color textColor = isDarkMode ? Colors.white : const Color(0xFF161616);
    final Color subTextColor = isDarkMode ? Colors.white70 : Colors.grey;

    return Scaffold(
      backgroundColor: backgroundColor,

      ////////////////////////////////////////////////
      /// DRAWER / MENU LATERAL (ESTILO SOLICITADO)
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
                    isSelected: true,
                    onTap: () => Navigator.pushReplacement(
                      context,
                      MaterialPageRoute(
                        builder: (_) => const DashboardPageFun(),
                      ),
                    ),
                  ),

                  _menuItem(
                    icon: Icons.videocam_outlined,
                    texto: "Análise de EPI",
                    isSelected: false,
                    onTap: () {
                      Navigator.push(
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
                    isSelected: false,
                    onTap: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(builder: (_) => const PerfilPage()),
                      );
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

      //////////////////////////////////////////////////////
      /// APP BAR
      //////////////////////////////////////////////////////
      appBar: AppBar(
        elevation: 0,
        backgroundColor: appBarColor,
        iconTheme: const IconThemeData(color: Color(0xFF0F62FE)),
        title: Row(
          children: [
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  "Bem-vindo,",
                  style: TextStyle(
                    color: isDarkMode ? Colors.white : const Color(0xFF0F62FE),
                    fontSize: 22,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                Text(
                  "Funcionario 1",
                  style: TextStyle(
                    color: subTextColor,
                    fontSize: 13,
                    fontWeight: FontWeight.w400,
                  ),
                ),
              ],
            ),
          ],
        ),
        actions: [
          // Botão Aumentar Fonte
          IconButton(
            icon: const Icon(Icons.text_increase, color: Color(0xFF0F62FE)),
            onPressed: () {
              context.read<AccessibilityController>().aumentarFonte();
            },
          ),
          // Botão Diminuir Fonte
          IconButton(
            icon: const Icon(Icons.text_decrease, color: Color(0xFF0F62FE)),
            onPressed: () {
              context.read<AccessibilityController>().diminuirFonte();
            },
          ),
          // Botão Modo Escuro / Claro (com chamada protegida)
          IconButton(
            icon: Icon(
              isDarkMode ? Icons.wb_sunny : Icons.nightlight_round,
              color: const Color(0xFF0F62FE),
            ),
            tooltip: "Alternar Modo Escuro",
            onPressed: () {
              try {
                (context.read<AccessibilityController>() as dynamic).toggleDarkMode();
              } catch (_) {
                try {
                  (context.read<AccessibilityController>() as dynamic).alternarTema();
                } catch (_) {}
              }
            },
          ),
          // Botão Leitor de Texto
          IconButton(
            icon: const Icon(Icons.volume_up, color: Color(0xFF0F62FE)),
            onPressed: () {
              final texto = """
              Bem-vindo Funcionario 1.
              Calendário de atividades.
              Dicas de segurança: Use sempre EPIs completos. Verifique seus equipamentos. Atenção às áreas de risco. Siga as normas da empresa.
              """;
              context.read<AccessibilityController>().lerTexto(texto);
            },
          ),
          const SizedBox(width: 10),
          Row(
            children: [
              CircleAvatar(
                radius: 18,
                backgroundColor: const Color(0xFF0F62FE),
                child: const Text(
                  "F",
                  style: TextStyle(
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
              const SizedBox(width: 8),
              Column(
                mainAxisAlignment: MainAxisAlignment.center,
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    "Funcionario 1",
                    style: TextStyle(
                      color: textColor,
                      fontSize: 13,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  Text(
                    "NEXA SOLUÇÕES",
                    style: TextStyle(color: subTextColor, fontSize: 10),
                  ),
                ],
              ),
            ],
          ),
          const SizedBox(width: 15),
        ],
      ),

      //////////////////////////////////////////////////////
      /// BODY CONSTRUÍDO DE ACORDO COM A IMAGEM
      //////////////////////////////////////////////////////
      body: LayoutBuilder(
        builder: (context, constraints) {
          bool isDesktop = constraints.maxWidth > 900;

          return SingleChildScrollView(
            padding: const EdgeInsets.all(24),
            child: isDesktop
                ? Row(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      const Expanded(flex: 3, child: CalendarioEPI()),
                      const SizedBox(width: 24),
                      const Expanded(flex: 2, child: _DicasSeguranca()),
                    ],
                  )
                : Column(
                    children: const [
                      CalendarioEPI(),
                      SizedBox(height: 24),
                      _DicasSeguranca(),
                    ],
                  ),
          );
        },
      ),
    );
  }
}

//////////////////////////////////////////////////////
// MENU ITEM AUXILIAR
//////////////////////////////////////////////////////
Widget _menuItem({
  required IconData icon,
  required String texto,
  required VoidCallback onTap,
  bool isSelected = false,
}) {
  return Padding(
    padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 3),
    child: InkWell(
      borderRadius: BorderRadius.circular(12),
      onTap: onTap,
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 12, horizontal: 16),
        decoration: BoxDecoration(
          color: isSelected ? const Color(0xFF0075E3) : Colors.transparent,
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

/// ==========================================
/// 📅 CALENDÁRIO (ESTILO DA IMAGEM)
/// ==========================================
class CalendarioEPI extends StatefulWidget {
  const CalendarioEPI({super.key});

  @override
  State<CalendarioEPI> createState() => _CalendarioEPIState();
}

class _CalendarioEPIState extends State<CalendarioEPI> {
  int mes = 8;
  int ano = 2026;

  final meses = [
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

  @override
  Widget build(BuildContext context) {
    final accessibility = context.watch<AccessibilityController>();
    bool isDarkMode = false;
    try {
      isDarkMode = (accessibility as dynamic).darkMode ?? (accessibility as dynamic).isDarkMode ?? false;
    } catch (_) {
      isDarkMode = false;
    }

    final Color cardColor = isDarkMode ? const Color(0xFF1A2B4C) : Colors.white;
    final Color textColor = isDarkMode ? Colors.white : const Color(0xFF161616);
    final Color subTextColor = isDarkMode ? Colors.white70 : Colors.grey;
    final Color itemColor = isDarkMode ? const Color(0xFF2A3B5C) : const Color(0xFFF4F6FA);

    int diasNoMes = DateTime(ano, mes + 1, 0).day;

    return Container(
      padding: const EdgeInsets.all(24),
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
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: const Color(0xFF0F62FE),
                  borderRadius: BorderRadius.circular(12),
                ),
                child: const Icon(
                  Icons.calendar_month_rounded,
                  color: Colors.white,
                  size: 22,
                ),
              ),
              const SizedBox(width: 15),
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    "Calendário",
                    style: TextStyle(
                      fontSize: 20,
                      fontWeight: FontWeight.bold,
                      color: textColor,
                    ),
                  ),
                  Text(
                    "Visualize os dias e suas atividades",
                    style: TextStyle(fontSize: 13, color: subTextColor),
                  ),
                ],
              ),
            ],
          ),

          const SizedBox(height: 25),

          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              IconButton(
                icon: const Icon(
                  Icons.arrow_left,
                  color: Color(0xFF0F62FE),
                  size: 30,
                ),
                onPressed: () {
                  setState(() {
                    mes--;
                    if (mes < 1) {
                      mes = 12;
                      ano--;
                    }
                  });
                },
              ),
              Column(
                children: [
                  Text(
                    meses[mes - 1],
                    style: const TextStyle(
                      fontWeight: FontWeight.bold,
                      fontSize: 18,
                      color: Color(0xFF0F62FE),
                    ),
                  ),
                  Text(
                    "$ano",
                    style: TextStyle(fontSize: 12, color: subTextColor),
                  ),
                ],
              ),
              IconButton(
                icon: const Icon(
                  Icons.arrow_right,
                  color: Color(0xFF0F62FE),
                  size: 30,
                ),
                onPressed: () {
                  setState(() {
                    mes++;
                    if (mes > 12) {
                      mes = 1;
                      ano++;
                    }
                  });
                },
              ),
            ],
          ),

          const SizedBox(height: 15),

          GridView.builder(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            itemCount: diasNoMes,
            gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
              crossAxisCount: 7,
              crossAxisSpacing: 10,
              mainAxisSpacing: 10,
              childAspectRatio: 1.2,
            ),
            itemBuilder: (context, index) {
              int dia = index + 1;

              return Container(
                decoration: BoxDecoration(
                  color: itemColor,
                  borderRadius: BorderRadius.circular(10),
                ),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Text(
                      "$dia",
                      style: const TextStyle(
                        fontWeight: FontWeight.bold,
                        fontSize: 15,
                        color: Color(0xFF0F62FE),
                      ),
                    ),
                    const SizedBox(height: 4),
                    const CircleAvatar(radius: 3, backgroundColor: Colors.grey),
                  ],
                ),
              );
            },
          ),

          const SizedBox(height: 25),

          Row(
            children: [
              _LegendaItem(cor: Colors.green, texto: "Correto", isDarkMode: isDarkMode),
              const SizedBox(width: 15),
              _LegendaItem(cor: Colors.red, texto: "Erro", isDarkMode: isDarkMode),
              const SizedBox(width: 15),
              _LegendaItem(cor: Colors.grey, texto: "Folga", isDarkMode: isDarkMode),
            ],
          ),
        ],
      ),
    );
  }
}

class _LegendaItem extends StatelessWidget {
  final Color cor;
  final String texto;
  final bool isDarkMode;

  const _LegendaItem({required this.cor, required this.texto, required this.isDarkMode});

  @override
  Widget build(BuildContext context) {
    return Row(
      children: [
        CircleAvatar(radius: 4, backgroundColor: cor),
        const SizedBox(width: 6),
        Text(
          texto,
          style: TextStyle(
            fontSize: 12,
            color: isDarkMode ? Colors.white70 : Colors.black87,
          ),
        ),
      ],
    );
  }
}

/// ==========================================
/// 🛡️ DICAS DE SEGURANÇA
/// ==========================================
class _DicasSeguranca extends StatelessWidget {
  const _DicasSeguranca();

  @override
  Widget build(BuildContext context) {
    final accessibility = context.watch<AccessibilityController>();
    bool isDarkMode = false;
    try {
      isDarkMode = (accessibility as dynamic).darkMode ?? (accessibility as dynamic).isDarkMode ?? false;
    } catch (_) {
      isDarkMode = false;
    }

    final Color cardColor = isDarkMode ? const Color(0xFF1A2B4C) : const Color(0xFFEBF3FF);

    return Container(
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: cardColor,
        borderRadius: BorderRadius.circular(20),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: const [
              Icon(Icons.shield_outlined, color: Color(0xFF0F62FE), size: 26),
              SizedBox(width: 10),
              Text(
                "Dicas de\nSegurança",
                style: TextStyle(
                  fontSize: 20,
                  fontWeight: FontWeight.bold,
                  color: Color(0xFF0F62FE),
                  height: 1.1,
                ),
              ),
            ],
          ),

          const SizedBox(height: 20),

          _cardDica(
            icon: Icons.security_outlined,
            texto: "Use sempre EPIs completos",
            isDarkMode: isDarkMode,
          ),
          _cardDica(
            icon: Icons.check_circle_outline,
            texto: "Verifique seus equipamentos",
            isDarkMode: isDarkMode,
          ),
          _cardDica(
            icon: Icons.warning_amber_rounded,
            texto: "Atenção às áreas de risco",
            isDarkMode: isDarkMode,
          ),
          _cardDica(
            icon: Icons.description_outlined,
            texto: "Siga as normas da empresa",
            isDarkMode: isDarkMode,
          ),
        ],
      ),
    );
  }

  Widget _cardDica({required IconData icon, required String texto, required bool isDarkMode}) {
    final Color itemCardColor = isDarkMode ? const Color(0xFF2A3B5C) : Colors.white;
    final Color itemTextColor = isDarkMode ? Colors.white : const Color(0xFF161616);
    final Color iconBgColor = isDarkMode ? const Color(0xFF1A2B4C) : const Color(0xFFEBF3FF);

    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: itemCardColor,
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.02),
            blurRadius: 8,
            offset: const Offset(0, 2),
          ),
        ],
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(8),
            decoration: BoxDecoration(
              color: iconBgColor,
              borderRadius: BorderRadius.circular(10),
            ),
            child: Icon(icon, color: const Color(0xFF0F62FE), size: 20),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Text(
              texto,
              style: TextStyle(
                fontSize: 13,
                fontWeight: FontWeight.w600,
                color: itemTextColor,
              ),
            ),
          ),
        ],
      ),
    );
  }
}