import 'dart:async';

import 'package:flutter/material.dart';
import 'package:nexa_app/views/dashboard_page_fun.dart'; // Mude aqui para o dashboard do funcionário se tiver um específico, ex: dashboard_funcionario_page.dart
import 'package:nexa_app/views/login_page.dart';
import 'package:url_launcher/url_launcher.dart';

// Controllers globais para gerenciar o Dark Mode e o Zoom da Fonte em toda a página
ValueNotifier<bool> darkModeNotifier = ValueNotifier<bool>(false);
ValueNotifier<double> fontSizeScaleNotifier = ValueNotifier<double>(1.0);

class InstitucionalPage extends StatefulWidget {
  const InstitucionalPage({super.key});

  @override
  State<InstitucionalPage> createState() => _InstitucionalPageState();
}

class _InstitucionalPageState extends State<InstitucionalPage> {
  final GlobalKey _sobreKey = GlobalKey();

  @override
  Widget build(BuildContext context) {
    return ValueListenableBuilder<bool>(
      valueListenable: darkModeNotifier,
      builder: (context, isDarkMode, child) {
        final Color backgroundColor = isDarkMode
            ? const Color(0xFF000000)
            : const Color(0xFFF9F9FA);
        final Color appBarColor = isDarkMode
            ? const Color(0xFF1A2B4C)
            : Colors.white;
        final Color textColor = isDarkMode ? Colors.white : Colors.black87;
        final Color brandColor = const Color(0xFF1A9DE7);

        return ValueListenableBuilder<double>(
          valueListenable: fontSizeScaleNotifier,
          builder: (context, fontScale, child) {
            return Scaffold(
              backgroundColor: backgroundColor,
              appBar: PreferredSize(
                preferredSize: const Size.fromHeight(70),
                child: AppBar(
                  backgroundColor: appBarColor,
                  elevation: 1,
                  automaticallyImplyLeading: false,
                  title: Center(
                    child: ConstrainedBox(
                      constraints: const BoxConstraints(maxWidth: 1200),
                      child: Padding(
                        padding: const EdgeInsets.symmetric(horizontal: 16),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            // LOGO ARREDONDADA ALTERNANDO ENTRE OS ATIVOS CONFORME O TEMA
                            Row(
                              children: [
                                ClipRRect(
                                  borderRadius: BorderRadius.circular(
                                    8 * fontScale,
                                  ),
                                  child: SizedBox(
                                    width: 32 * fontScale,
                                    height: 32 * fontScale,
                                    child: Image.asset(
                                      isDarkMode
                                          ? 'assets/escuro.png'
                                          : 'assets/logo.nexa.png',
                                      fit: BoxFit.cover,
                                    ),
                                  ),
                                ),
                                const SizedBox(width: 10),
                                Text(
                                  "NEXA",
                                  style: TextStyle(
                                    color: textColor,
                                    fontSize: 22 * fontScale,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                              ],
                            ),

                            // BOTÕES DO MENU COM CORES PADRONIZADAS
                            Row(
                              children: [
                                // Botão A+ sem sombra e padronizado
                                InkWell(
                                  onTap: () {
                                    if (fontSizeScaleNotifier.value < 1.4) {
                                      fontSizeScaleNotifier.value += 0.1;
                                    }
                                  },
                                  child: Padding(
                                    padding: const EdgeInsets.symmetric(
                                      horizontal: 6,
                                      vertical: 4,
                                    ),
                                    child: Text(
                                      "A+",
                                      style: TextStyle(
                                        color: brandColor,
                                        fontWeight: FontWeight.bold,
                                        fontSize: 16 * fontScale,
                                      ),
                                    ),
                                  ),
                                ),
                                const SizedBox(width: 4),

                                // BOTÃO DE MODO ESCURO / CLARO AO LADO DO A+
                                IconButton(
                                  icon: Icon(
                                    isDarkMode
                                        ? Icons.wb_sunny
                                        : Icons.nightlight_round,
                                    color: brandColor,
                                    size: 22,
                                  ),
                                  tooltip: "Alternar Modo Escuro",
                                  onPressed: () {
                                    darkModeNotifier.value =
                                        !darkModeNotifier.value;
                                  },
                                ),
                                const SizedBox(width: 4),

                                // Botão A- padronizado
                                InkWell(
                                  onTap: () {
                                    if (fontSizeScaleNotifier.value > 0.8) {
                                      fontSizeScaleNotifier.value -= 0.1;
                                    }
                                  },
                                  child: Padding(
                                    padding: const EdgeInsets.symmetric(
                                      horizontal: 6,
                                      vertical: 4,
                                    ),
                                    child: Text(
                                      "A-",
                                      style: TextStyle(
                                        color: brandColor,
                                        fontWeight: FontWeight.bold,
                                        fontSize: 16 * fontScale,
                                      ),
                                    ),
                                  ),
                                ),
                                const SizedBox(width: 16),

                                // Botão de Som / Áudio padronizado
                                IconButton(
                                  icon: Icon(
                                    Icons.volume_up,
                                    color: brandColor,
                                    size: 20,
                                  ),
                                  onPressed: () {},
                                ),
                                const SizedBox(width: 16),

                                // Botão Entrar direcionando para LoginPage de Funcionário
                                ElevatedButton(
                                  onPressed: () {
                                    Navigator.push(
                                      context,
                                      MaterialPageRoute(
                                        builder: (_) => LoginPage(
                                          onLogin: () {
                                            // AQUI VOCÊ DIRECIONA PARA O DASHBOARD ESPECÍFICO DO FUNCIONÁRIO
                                            Navigator.pushReplacement(
                                              context,
                                              MaterialPageRoute(
                                                builder: (_) => DashboardPageFun(),
                                              ),
                                            );
                                          },
                                          onVoltar: () {
                                            Navigator.pop(context);
                                          },
                                        ),
                                      ),
                                    );
                                  },
                                  style: ElevatedButton.styleFrom(
                                    backgroundColor: brandColor,
                                    foregroundColor: Colors.white,
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(20),
                                    ),
                                  ),
                                  child: Text(
                                    "Entrar",
                                    style: TextStyle(fontSize: 14 * fontScale),
                                  ),
                                ),
                              ],
                            ),
                          ],
                        ),
                      ),
                    ),
                  ),
                ),
              ),
              body: SingleChildScrollView(
                child: Column(
                  children: [
                    Center(
                      child: ConstrainedBox(
                        constraints: const BoxConstraints(maxWidth: 1200),
                        child: Padding(
                          padding: const EdgeInsets.symmetric(
                            horizontal: 24,
                            vertical: 20,
                          ),
                          child: Column(
                            children: [
                              /// CONTEÚDO PRINCIPAL (COM GRADIENTE E BORDAS ARREDONDADAS)
                              Container(
                                width: double.infinity,
                                decoration: BoxDecoration(
                                  gradient: const LinearGradient(
                                    colors: [
                                      Color(0xFF1A2B4C),
                                      Color(0xFF1A9DE7),
                                    ],
                                  ),
                                  borderRadius: BorderRadius.circular(16),
                                ),
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    Padding(
                                      padding: const EdgeInsets.all(40),
                                      child: Column(
                                        crossAxisAlignment:
                                            CrossAxisAlignment.start,
                                        children: [
                                          /// TÍTULO
                                          RichText(
                                            text: TextSpan(
                                              children: [
                                                TextSpan(
                                                  text: 'Safety at the',
                                                  style: TextStyle(
                                                    color: const Color.fromARGB(
                                                      252,
                                                      1,
                                                      152,
                                                      253,
                                                    ),
                                                    fontSize: 70 * fontScale,
                                                  ),
                                                ),
                                                TextSpan(
                                                  text: ' Core',
                                                  style: TextStyle(
                                                    color: const Color.fromARGB(
                                                      251,
                                                      255,
                                                      255,
                                                      255,
                                                    ),
                                                    fontSize: 70 * fontScale,
                                                  ),
                                                ),
                                              ],
                                            ),
                                          ),

                                          const SizedBox(height: 20),

                                          /// TEXTO
                                          Text(
                                            "A NEXA é uma plataforma inteligente de segurança do trabalho, unindo tecnologia, dados e automação para proteger pessoas e operações.",
                                            style: TextStyle(
                                              color: const Color.fromARGB(
                                                255,
                                                255,
                                                255,
                                                255,
                                              ),
                                              fontSize: 16 * fontScale,
                                            ),
                                          ),

                                          const SizedBox(height: 30),

                                          /// BOTÕES DA SEÇÃO PRINCIPAL
                                          Wrap(
                                            spacing: 15,
                                            runSpacing: 10,
                                            children: [
                                              /// ACESSAR (direcionando para LoginPage)
                                              ElevatedButton(
                                                onPressed: () {
                                                  Navigator.push(
                                                    context,
                                                    MaterialPageRoute(
                                                      builder: (_) => LoginPage(
                                                        onLogin: () {
                                                          Navigator.pushReplacement(
                                                            context,
                                                            MaterialPageRoute(
                                                              builder: (_) =>
                                                                  DashboardPageFun(
                                                                   
                                                                  ),
                                                            ),
                                                          );
                                                        },
                                                        onVoltar: () {
                                                          Navigator.pop(
                                                            context,
                                                          );
                                                        },
                                                      ),
                                                    ),
                                                  );
                                                },
                                                style: ElevatedButton.styleFrom(
                                                  backgroundColor: Colors.white,
                                                  foregroundColor: const Color(
                                                    0xFF1A2B4C,
                                                  ),
                                                  padding:
                                                      const EdgeInsets.symmetric(
                                                        horizontal: 30,
                                                        vertical: 15,
                                                      ),
                                                  shape: RoundedRectangleBorder(
                                                    borderRadius:
                                                        BorderRadius.circular(
                                                          10,
                                                        ),
                                                  ),
                                                ),
                                                child: Text(
                                                  "Acesse o app",
                                                  style: TextStyle(
                                                    color: const Color(
                                                      0xFF1A2B4C,
                                                    ),
                                                    fontWeight: FontWeight.bold,
                                                    fontSize: 14 * fontScale,
                                                  ),
                                                ),
                                              ),

                                              /// SOBRE NÓS (SCROLL)
                                              OutlinedButton(
                                                onPressed: () {
                                                  Scrollable.ensureVisible(
                                                    _sobreKey.currentContext!,
                                                    duration: const Duration(
                                                      milliseconds: 600,
                                                    ),
                                                    curve: Curves.easeInOut,
                                                  );
                                                },
                                                style: OutlinedButton.styleFrom(
                                                  side: const BorderSide(
                                                    color: Color.fromARGB(
                                                      255,
                                                      255,
                                                      255,
                                                      255,
                                                    ),
                                                  ),
                                                  padding:
                                                      const EdgeInsets.symmetric(
                                                        horizontal: 30,
                                                        vertical: 15,
                                                      ),
                                                  shape: RoundedRectangleBorder(
                                                    borderRadius:
                                                        BorderRadius.circular(
                                                          10,
                                                        ),
                                                  ),
                                                ),
                                                child: Text(
                                                  "Sobre nós",
                                                  style: TextStyle(
                                                    color: const Color.fromARGB(
                                                      255,
                                                      255,
                                                      255,
                                                      255,
                                                    ),
                                                    fontSize: 14 * fontScale,
                                                  ),
                                                ),
                                              ),
                                            ],
                                          ),
                                        ],
                                      ),
                                    ),
                                    ClipRRect(
                                      borderRadius: const BorderRadius.only(
                                        bottomLeft: Radius.circular(16),
                                        bottomRight: Radius.circular(16),
                                      ),
                                      child: SizedBox(
                                        height: 250,
                                        child: const Carrossel(),
                                      ),
                                    ),
                                  ],
                                ),
                              ),

                              const SizedBox(height: 50),

                              ValoresSection(
                                isDarkMode: isDarkMode,
                                fontScale: fontScale,
                              ),
                              const Divider(),

                              const SizedBox(height: 50),

                              SolucoesSection(
                                isDarkMode: isDarkMode,
                                fontScale: fontScale,
                              ),
                              const Divider(),

                              const SizedBox(height: 50),

                              VisaoComputacionalSection(
                                isDarkMode: isDarkMode,
                                fontScale: fontScale,
                              ),

                              const Divider(),

                              const SizedBox(height: 50),

                              /// SOBRE COM KEY
                              SobreSection(
                                key: _sobreKey,
                                isDarkMode: isDarkMode,
                                fontScale: fontScale,
                              ),

                              const SizedBox(height: 40),
                            ],
                          ),
                        ),
                      ),
                    ),

                    /// FOOTER
                    const FooterNexa(),
                  ],
                ),
              ),
            );
          },
        );
      },
    );
  }
}

class Carrossel extends StatefulWidget {
  const Carrossel({super.key});

  @override
  State<Carrossel> createState() => _CarrosselState();
}

class _CarrosselState extends State<Carrossel> {
  final PageController _controller = PageController();
  int paginaAtual = 0;
  Timer? timer;

  final imagens = [
    'assets/slide1.jpg',
    'assets/slide2.jpg',
    'assets/slide3.jpg',
  ];

  @override
  void initState() {
    super.initState();

    timer = Timer.periodic(const Duration(seconds: 3), (timer) {
      if (paginaAtual < imagens.length - 1) {
        paginaAtual++;
      } else {
        paginaAtual = 0;
      }

      _controller.animateToPage(
        paginaAtual,
        duration: const Duration(milliseconds: 800),
        curve: Curves.easeInOut,
      );
    });
  }

  @override
  void dispose() {
    timer?.cancel();
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return PageView(
      physics: const BouncingScrollPhysics(),
      controller: _controller,
      children: imagens
          .map((url) => Image.asset(url, fit: BoxFit.cover))
          .toList(),
    );
  }
}

class ValoresSection extends StatelessWidget {
  final bool isDarkMode;
  final double fontScale;
  const ValoresSection({
    super.key,
    required this.isDarkMode,
    required this.fontScale,
  });

  Widget cardValor(IconData icone, String titulo, String descricao) {
    return LayoutBuilder(
      builder: (context, constraints) {
        return Container(
          margin: const EdgeInsets.only(bottom: 20),
          padding: const EdgeInsets.all(20),
          decoration: BoxDecoration(
            color: isDarkMode ? const Color(0xFF1A2B4C) : Colors.white,
            borderRadius: BorderRadius.circular(15),
            boxShadow: [
              BoxShadow(
                color: isDarkMode ? Colors.black54 : Colors.black12,
                blurRadius: 10,
                offset: const Offset(0, 4),
              ),
            ],
          ),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Icon(icone, color: const Color(0xFF1A9DE7), size: 30 * fontScale),
              const SizedBox(width: 15),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      titulo,
                      style: TextStyle(
                        fontSize: 18 * fontScale,
                        fontWeight: FontWeight.bold,
                        color: isDarkMode ? Colors.white : Colors.black87,
                      ),
                    ),
                    const SizedBox(height: 8),
                    Text(
                      descricao,
                      style: TextStyle(
                        color: isDarkMode ? Colors.white70 : Colors.black87,
                        fontSize: 14 * fontScale,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          "Missão, Visão e Valores",
          style: TextStyle(
            fontSize: 32 * fontScale,
            fontWeight: FontWeight.bold,
            color: isDarkMode ? Colors.white : Colors.black,
          ),
        ),
        const SizedBox(height: 10),
        Text(
          "Os princípios que orientam a NEXA refletem nosso compromisso com inovação, ética e proteção da vida.",
          style: TextStyle(
            color: isDarkMode ? Colors.white70 : Colors.black54,
            fontSize: 14 * fontScale,
          ),
        ),
        const SizedBox(height: 30),
        cardValor(
          Icons.playlist_add_check_circle_rounded,
          "Missão",
          "Transformar a segurança do trabalho em inteligência, promovendo ambientes mais seguros e eficientes.",
        ),
        cardValor(
          Icons.visibility_outlined,
          "Visão",
          "Ser referência global em soluções tecnológicas de segurança e compliance corporativo.",
        ),
        cardValor(
          Icons.balance,
          "Valores",
          "Ética, inovação, responsabilidade social, transparência e compromisso com a vida.",
        ),
      ],
    );
  }
}

class VisaoComputacionalSection extends StatelessWidget {
  final bool isDarkMode;
  final double fontScale;
  const VisaoComputacionalSection({
    super.key,
    required this.isDarkMode,
    required this.fontScale,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          "Visão Computacional",
          style: TextStyle(
            fontSize: 32 * fontScale,
            fontWeight: FontWeight.bold,
            color: isDarkMode ? Colors.white : Colors.black,
          ),
        ),
        const SizedBox(height: 20),
        Container(
          width: double.infinity,
          padding: const EdgeInsets.all(25),
          decoration: BoxDecoration(
            color: isDarkMode ? const Color(0xFF1A2B4C) : Colors.white,
            borderRadius: BorderRadius.circular(15),
            boxShadow: [
              BoxShadow(
                color: isDarkMode ? Colors.black54 : Colors.black12,
                blurRadius: 10,
                offset: const Offset(0, 4),
              ),
            ],
          ),
          child: Text(
            "A visão computacional é um campo da inteligência artificial que treina computadores para interpretar e compreender o mundo visual de forma semelhante aos humanos. Utilizando modelos de aprendizado de máquina e redes neurais profundas, o sistema analisa imagens digitais, vídeos e entradas de sensores para identificar padrões, detectar objetos, classificar cenas e até rastrear movimentos. Na NEXA, usamos a visão computacional para detectar o uso de EPI's pelos funcionários, aliando segurança e tecnologia para o benefício de todos.",
            style: TextStyle(
              color: isDarkMode ? Colors.white70 : Colors.black87,
              fontSize: 15 * fontScale,
            ),
          ),
        ),
        const SizedBox(height: 30),
      ],
    );
  }
}

class SolucoesSection extends StatelessWidget {
  final bool isDarkMode;
  final double fontScale;
  const SolucoesSection({
    super.key,
    required this.isDarkMode,
    required this.fontScale,
  });

  Widget cardSolucao(IconData icone, String titulo, String descricao) {
    return LayoutBuilder(
      builder: (context, constraints) {
        return Container(
          margin: const EdgeInsets.only(bottom: 20),
          padding: const EdgeInsets.all(20),
          decoration: BoxDecoration(
            color: isDarkMode ? const Color(0xFF1A2B4C) : Colors.white,
            borderRadius: BorderRadius.circular(20),
            boxShadow: [
              BoxShadow(
                color: isDarkMode ? Colors.black54 : Colors.black12,
                blurRadius: 10,
                offset: const Offset(0, 5),
              ),
            ],
          ),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Icon(icone, size: 40 * fontScale, color: const Color(0xFF1A9DE7)),
              const SizedBox(width: 15),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      titulo,
                      style: TextStyle(
                        fontSize: 18 * fontScale,
                        fontWeight: FontWeight.bold,
                        color: isDarkMode ? Colors.white : Colors.black87,
                      ),
                    ),
                    const SizedBox(height: 8),
                    Text(
                      descricao,
                      style: TextStyle(
                        color: isDarkMode ? Colors.white70 : Colors.black87,
                        fontSize: 14 * fontScale,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          "Nossas Soluções",
          style: TextStyle(
            fontSize: 32 * fontScale,
            fontWeight: FontWeight.bold,
            color: isDarkMode ? Colors.white : Colors.black,
          ),
        ),
        const SizedBox(height: 10),
        Text(
          "A NEXA oferece soluções digitais integradas que garantem segurança, conformidade e inteligência operacional em ambientes corporativos e industriais.",
          style: TextStyle(
            fontSize: 16 * fontScale,
            color: isDarkMode ? Colors.white70 : Colors.black54,
          ),
        ),
        const SizedBox(height: 30),
        cardSolucao(
          Icons.security,
          "Monitoramento de EPIs",
          "Identificação automática do uso correto de EPIs..",
        ),
        cardSolucao(
          Icons.bar_chart,
          "Relatórios Inteligentes",
          "Análises em tempo real para decisões estratégicas.",
        ),
        cardSolucao(
          Icons.join_inner_outlined,
          "Compliance Global",
          "Adequação às normas nacionais e internacionais.",
        ),
        cardSolucao(
          Icons.circle_notifications_rounded,
          "Alertas em Tempo Real",
          "Notificações imediatas para prevenção de acidentes.",
        ),
        cardSolucao(
          Icons.data_usage,
          "Centralização de Dados",
          "Histórico seguro e rastreável de informações.",
        ),
        cardSolucao(
          Icons.security,
          "Gestão de Riscos",
          "Mitigação de riscos com apoio tecnológico.",
        ),
        const SizedBox(height: 30),
      ],
    );
  }
}

// SOBRE NÓS
class SobreSection extends StatelessWidget {
  final bool isDarkMode;
  final double fontScale;
  const SobreSection({
    super.key,
    required this.isDarkMode,
    required this.fontScale,
  });

  Widget cardMembro(String imagem, String nome, String cargo) {
    return LayoutBuilder(
      builder: (context, constraints) {
        return Container(
          width: 270,
          padding: const EdgeInsets.all(20),
          decoration: BoxDecoration(
            color: isDarkMode ? const Color(0xFF1A2B4C) : Colors.white,
            borderRadius: BorderRadius.circular(15),
            boxShadow: [
              BoxShadow(
                color: isDarkMode ? Colors.black54 : Colors.black12,
                blurRadius: 8,
                offset: const Offset(0, 4),
              ),
            ],
          ),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              CircleAvatar(radius: 35, backgroundImage: AssetImage(imagem)),
              const SizedBox(height: 10),
              Text(
                nome,
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  color: isDarkMode ? Colors.white : Colors.black87,
                  fontSize: 14 * fontScale,
                ),
              ),
              const SizedBox(height: 5),
              Text(
                cargo,
                textAlign: TextAlign.center,
                style: TextStyle(
                  color: isDarkMode ? Colors.white70 : Colors.black54,
                  fontSize: 12 * fontScale,
                ),
              ),
            ],
          ),
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          "Sobre a NEXA",
          style: TextStyle(
            fontSize: 32 * fontScale,
            fontWeight: FontWeight.bold,
            color: isDarkMode ? Colors.white : Colors.black,
          ),
        ),
        const SizedBox(height: 10),
        Text(
          "A NEXA nasceu com o propósito de transformar a segurança do trabalho em um processo inteligente, integrado e orientado por dados.\n\n"
          "Nossa plataforma combina monitoramento inteligente, análise de dados em tempo real e conformidade normativa para garantir ambientes de trabalho mais seguros.",
          style: TextStyle(
            color: isDarkMode ? Colors.white70 : Colors.black54,
            fontSize: 14 * fontScale,
          ),
        ),
        const SizedBox(height: 30),

        Wrap(
          spacing: 20,
          runSpacing: 20,
          children: [
            SizedBox(
              width: 350,
              child: _infoCard(
                Icons.flag,
                "Propósito",
                "Elevar o padrão da segurança do trabalho.",
              ),
            ),
            SizedBox(
              width: 350,
              child: _infoCard(
                Icons.lightbulb,
                "Inovação",
                "Tecnologia para antecipar riscos.",
              ),
            ),
            SizedBox(
              width: 350,
              child: _infoCard(
                Icons.verified,
                "Compromisso",
                "Proteção da vida em primeiro lugar.",
              ),
            ),
          ],
        ),

        const SizedBox(height: 50),

        Text(
          "Nossa Equipe",
          style: TextStyle(
            fontSize: 24 * fontScale,
            fontWeight: FontWeight.bold,
            color: isDarkMode ? Colors.white : Colors.black,
          ),
        ),
        const SizedBox(height: 20),

        Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            /// ANÁLISE E DESIGN
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  "Análise e Design",
                  style: TextStyle(
                    fontSize: 20 * fontScale,
                    fontWeight: FontWeight.bold,
                    color: isDarkMode ? Colors.white : Colors.black87,
                  ),
                ),
                const SizedBox(height: 20),

                Row(
                  children: [
                    Expanded(
                      child: cardMembro(
                        "assets/ryan.jpg",
                        "Ryan Donizetti Porto",
                        "Analista de Sistemas e Design",
                      ),
                    ),
                    const SizedBox(width: 20),
                    Expanded(
                      child: cardMembro(
                        "assets/laura.png",
                        "Laura Costa Ubaldo",
                        "Analista de Sistemas e Design",
                      ),
                    ),
                  ],
                ),
              ],
            ),

            const SizedBox(height: 30),

            /// DESENVOLVIMENTO FULL STACK
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  "Desenvolvimento Full Stack",
                  style: TextStyle(
                    fontSize: 20 * fontScale,
                    fontWeight: FontWeight.bold,
                    color: isDarkMode ? Colors.white : Colors.black87,
                  ),
                ),
                const SizedBox(height: 20),

                Row(
                  children: [
                    Expanded(
                      child: cardMembro(
                        "assets/livia.png",
                        "Livia Bussaglia Bispo",
                        "Programadora Full Stack",
                      ),
                    ),
                    const SizedBox(width: 20),
                    Expanded(
                      child: cardMembro(
                        "assets/bruno.png",
                        "Bruno Donizetti Souza",
                        "Full Stack e Product Owner",
                      ),
                    ),
                  ],
                ),
              ],
            ),

            const SizedBox(height: 30),

            /// DESENVOLVIMENTO BACK-END
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  "Desenvolvimento Back-End",
                  style: TextStyle(
                    fontSize: 20 * fontScale,
                    fontWeight: FontWeight.bold,
                    color: isDarkMode ? Colors.white : Colors.black87,
                  ),
                ),
                const SizedBox(height: 20),

                Row(
                  children: [
                    Expanded(
                      child: cardMembro(
                        "assets/nicoly.png",
                        "Nicoly Gentina Geribola",
                        "Back-End e Scrum Master",
                      ),
                    ),
                    const SizedBox(width: 20),
                    Expanded(
                      child: cardMembro(
                        "assets/erik.png",
                        "Erick Donizetti Ferreira",
                        "Programador Back-End",
                      ),
                    ),
                    const SizedBox(width: 20),
                    Expanded(
                      child: cardMembro(
                        "assets/fernanda.png",
                        "Fernanda Machado Nogueira",
                        "Programadora Back-End",
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ],
        ),
      ],
    );
  }

  Widget _infoCard(IconData icon, String titulo, String texto) {
    return LayoutBuilder(
      builder: (context, constraints) {
        return Container(
          padding: const EdgeInsets.all(25),
          decoration: BoxDecoration(
            color: isDarkMode ? const Color(0xFF1A2B4C) : Colors.white,
            borderRadius: BorderRadius.circular(10),
            boxShadow: [
              BoxShadow(
                color: isDarkMode ? Colors.black54 : Colors.black12,
                blurRadius: 6,
                offset: const Offset(0, 3),
              ),
            ],
          ),
          child: Row(
            children: [
              Icon(icon, color: const Color(0xFF1A9DE7), size: 35 * fontScale),
              const SizedBox(width: 15),
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      titulo,
                      style: TextStyle(
                        fontWeight: FontWeight.bold,
                        fontSize: 18 * fontScale,
                        color: isDarkMode ? Colors.white : Colors.black87,
                      ),
                    ),
                    const SizedBox(height: 5),
                    Text(
                      texto,
                      style: TextStyle(
                        fontSize: 14 * fontScale,
                        color: isDarkMode ? Colors.white70 : Colors.black87,
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        );
      },
    );
  }
}

class FooterNexa extends StatelessWidget {
  const FooterNexa({super.key});

  Future<void> abrirLink(String url) async {
    final Uri uri = Uri.parse(url);

    if (!await launchUrl(uri, mode: LaunchMode.externalApplication)) {
      throw 'Não foi possível abrir $url';
    }
  }

  @override
  Widget build(BuildContext context) {
    double largura = MediaQuery.of(context).size.width;
    bool isMobile = largura < 600;

    return Container(
      width: double.infinity,
      decoration: const BoxDecoration(
        color: Colors.black,
        boxShadow: [
          BoxShadow(
            color: Colors.black26,
            blurRadius: 10,
            offset: Offset(0, -2),
          ),
        ],
      ),
      padding: EdgeInsets.symmetric(
        horizontal: isMobile ? 15 : 40,
        vertical: 20,
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Row(
            children: [
              const Icon(
                Icons.security,
                color: Color.fromARGB(255, 251, 252, 253),
                size: 18,
              ),
              const SizedBox(width: 8),
              const Text(
                "NEXA",
                style: TextStyle(
                  color: Color.fromARGB(255, 232, 233, 236),
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const SizedBox(width: 20),
              IconButton(
                icon: const Icon(
                  Icons.camera_alt,
                  color: Colors.white70,
                  size: 18,
                ),
                onPressed: () {
                  abrirLink(
                    "https://www.instagram.com/nexa.senai/?utm_source=ig_web_button_share_sheet",
                  );
                },
              ),
              IconButton(
                icon: const Icon(
                  Icons.music_note,
                  color: Colors.white70,
                  size: 18,
                ),
                onPressed: () {
                  abrirLink(
                    "https://www.tiktok.com/@nexa.senai?_r=1&_t=ZS-95X8QioYNRU",
                  );
                },
              ),
              IconButton(
                icon: const Icon(Icons.email, color: Colors.white70, size: 18),
                onPressed: () {
                  abrirLink(
                    Uri.encodeFull(
                      "mailto:nexa.senai@gmail.com?subject=Contato NEXA&body=Olá, gostaria de falar com vocês.",
                    ),
                  );
                },
              ),
            ],
          ),
          if (!isMobile)
            Row(
              children: const [
                Icon(Icons.info_outline, color: Colors.white70, size: 16),
                SizedBox(width: 5),
                Text(
                  "Sobre",
                  style: TextStyle(color: Colors.white70, fontSize: 12),
                ),
                SizedBox(width: 20),
                Icon(Icons.settings, color: Colors.white70, size: 16),
                SizedBox(width: 5),
                Text(
                  "Soluções",
                  style: TextStyle(color: Colors.white70, fontSize: 12),
                ),
                SizedBox(width: 20),
                Icon(Icons.mail_outline, color: Colors.white70, size: 16),
                SizedBox(width: 5),
                Text(
                  "Contato",
                  style: TextStyle(color: Colors.white70, fontSize: 12),
                ),
                SizedBox(width: 20),
              ],
            ),
          Row(
            children: [
              GestureDetector(
                onDoubleTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (_) => LoginPage(
                        onLogin: () {
                          Navigator.pushReplacement(
                            context,
                            MaterialPageRoute(
                              builder: (_) => DashboardPageFun(
                              
                              ),
                            ),
                          );
                        },
                        onVoltar: () {
                          Navigator.pop(context);
                        },
                      ),
                    ),
                  );
                },
                child: Row(
                  children: const [
                    Icon(Icons.lock_outline, color: Colors.white38, size: 14),
                    SizedBox(width: 4),
                    Text(
                      "Admin",
                      style: TextStyle(color: Colors.white38, fontSize: 11),
                    ),
                  ],
                ),
              ),
              const SizedBox(width: 15),
              const Text(
                "© 2026",
                style: TextStyle(color: Colors.white38, fontSize: 11),
              ),
            ],
          ),
        ],
      ),
    );
  }
}
