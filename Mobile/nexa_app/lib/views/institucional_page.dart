 import 'dart:async';

import 'package:flutter/material.dart';
import 'package:nexa_app/menu_appbar.dart';
import 'package:nexa_app/views/dashboard_page.dart';
import 'package:nexa_app/views/login_page.dart';
import 'package:nexa_app/views/loginadm_page.dart';
import 'package:url_launcher/url_launcher.dart';


class InstitucionalPage extends StatefulWidget {
  const InstitucionalPage({super.key});

  @override
  State<InstitucionalPage> createState() => _InstitucionalPageState();
}

class _InstitucionalPageState extends State<InstitucionalPage> {
  final GlobalKey _sobreKey = GlobalKey();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color.fromARGB(255, 249, 249, 250),

      appBar: menuAppBar(context),

     body: SingleChildScrollView(
  child: Column(
    children: [
      /// CONTEÚDO PRINCIPAL
      Container(
        width: double.infinity,
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            colors: [Color(0xFF0A66C2), Color(0xFF003C8F)],
          ),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
         children: [

         Padding(
          padding: const EdgeInsets.all(40),
          child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            /// TÍTULO
            RichText(
              text: TextSpan(
                children: [
                  TextSpan(
                    text: 'Safety at the',
                    style: TextStyle(color: const Color.fromARGB(252, 1, 152, 253), fontSize: 70),
                  ),
                  TextSpan(
                    text: ' Core',
                    style: TextStyle(
                      color:  Color.fromARGB(251, 255, 255, 255),
                      fontSize: 70,
                    ),
                  ),
                ],
              ),
            ),

            const SizedBox(height: 20),

            /// TEXTO
            const Text(
              "A NEXA é uma plataforma inteligente de segurança do trabalho, unindo tecnologia, dados e automação para proteger pessoas e operações.",
              style: TextStyle(
                      color: Color.fromARGB(255, 255, 255, 255),
                    ),
            ),

            const SizedBox(height: 30),

            /// BOTÕES
            Wrap(
              spacing: 15,
              runSpacing: 10,
              children: [
                /// ACESSAR
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
                builder: (_) => Dashboard(
                  onLogout: () {
                    Navigator.pop(context);
                  },
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
  style: ElevatedButton.styleFrom(
    backgroundColor: Colors.white, // 🔥 fundo branco
    foregroundColor: const Color(0xFF0A66C2), // 🔥 cor padrão do texto
    padding: const EdgeInsets.symmetric(horizontal: 30, vertical: 15),
    shape: RoundedRectangleBorder(
      borderRadius: BorderRadius.circular(10),
    ),
  ),
  child: const Text(
    "Acesse o app",
    style: TextStyle(
      color: Color(0xFF0A66C2), // 🔥 texto azul
      fontWeight: FontWeight.bold,
    ),
  ),
),

                /// SOBRE NÓS (SCROLL)
                OutlinedButton(
                  onPressed: () {
                    Scrollable.ensureVisible(
                      _sobreKey.currentContext!,
                      duration: const Duration(milliseconds: 600),
                      curve: Curves.easeInOut,
                    );
                  },
                  style: OutlinedButton.styleFrom(
                    side: const BorderSide(color: Color.fromARGB(255, 255, 255, 255)),
                    padding: const EdgeInsets.symmetric(
                        horizontal: 30, vertical: 15),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(10),
                    ),
                  ),
                  child: const Text(
                    "Sobre nós",
                    style: TextStyle(color: Color.fromARGB(255, 255, 255, 255),),
                  ),
                ),
              ],
            ),

          
            ],
           ),
      ),
        SizedBox(
              height: 200,
              child: Carrossel(),
         ),
         
         ],

      ),

   
    ),
       const SizedBox(height: 50),
      

            const ValoresSection(),
            const Divider(),

            const SizedBox(height: 50),

            const SolucoesSection(),
            const Divider(),



          

            const VisaoComputacionalSection(),

            const Divider(),

            const SizedBox(height: 50),

            /// SOBRE COM KEY
            SobreSection(key: _sobreKey),

            const SizedBox(height: 40),

      /// FOOTER
      const FooterNexa(),
          ],
          
        ),
      ),
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
  const ValoresSection({super.key});

  Widget cardValor(IconData icone, String titulo, String descricao) {
    return Container(
      margin: const EdgeInsets.only(bottom: 20),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(15),
        boxShadow: const [
          BoxShadow(
            color: Colors.black12,
            blurRadius: 10,
            offset: Offset(0, 4),
          ),
        ],
      ),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Icon(icone, color: Color(0xFF0A66C2), size: 30),
          const SizedBox(width: 15),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  titulo,
                  style: const TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 8),
                Text(
                  descricao,
                  style: const TextStyle(color: Colors.black87),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Column(
          
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            /// TÍTULO
            const SizedBox(height: 40),
            const Text(
              "Missão, Visão e Valores",
              style: TextStyle(
                fontSize: 32,
                fontWeight: FontWeight.bold,
              ),
            ),

            const SizedBox(height: 10),

            const Text(
              "Os princípios que orientam a NEXA refletem nosso compromisso com inovação, ética e proteção da vida.",
              style: TextStyle(color: Colors.black54),
            ),

            const SizedBox(height: 30),

            /// CARDS DE VALORES
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
  const VisaoComputacionalSection({super.key});

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const SizedBox(height: 40),

        /// TÍTULO
        const Text(
          "Visão Computacional",
          style: TextStyle(
            fontSize: 32,
            fontWeight: FontWeight.bold,
          ),
        ),

        const SizedBox(height: 20),

        /// CARD BRANCO
        Container(
          width: double.infinity,
          padding: const EdgeInsets.all(25),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(15),
            boxShadow: const [
              BoxShadow(
                color: Colors.black12,
                blurRadius: 10,
                offset: Offset(0, 4),
              ),
            ],
          ),
          child: const Text(
            "A visão computacional é um campo da inteligência artificial que treina computadores para interpretar e compreender o mundo visual de forma semelhante aos humanos. Utilizando modelos de aprendizado de máquina e redes neurais profundas, o sistema analisa imagens digitais, vídeos e entradas de sensores para identificar padrões, detectar objetos, classificar cenas e até rastrear movimentos. Na NEXA, usamos a visão computacional para detectar o uso de EPI's pelos funcionários, aliando segurança e tecnologia para o benefício de todos.",
            style: TextStyle(
              color: Colors.black87,
              fontSize: 15,
            ),
          ),
        ),

        const SizedBox(height: 30),
      ],
    );
  }
}



class SolucoesSection extends StatelessWidget {
  const SolucoesSection({super.key});

  Widget cardSolucao(IconData icone, String titulo, String descricao) {
    return Container(
      margin: const EdgeInsets.only(bottom: 20),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(20),
        boxShadow: const [
          BoxShadow(
            color: Colors.black12,
            blurRadius: 10,
            offset: Offset(0, 5),
          )
        ],
      ),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Icon(icone, size: 40, color: const Color(0xFF0A66C2)),
          const SizedBox(width: 15),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  titulo,
                  style: const TextStyle(
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 8),
                Text(
                  descricao,
                  style: const TextStyle(color: Colors.black87),
                ),
              ],
            ),
          )
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Column(
     
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              "Nossas Soluções",
              style: TextStyle(
                fontSize: 32,
                fontWeight: FontWeight.bold,
              ),
            ),

            const SizedBox(height: 10),

            const Text(
              "A NEXA oferece soluções digitais integradas que garantem segurança, conformidade e inteligência operacional em ambientes corporativos e industriais.",
              style: TextStyle(fontSize: 16, color: Colors.black54),
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





//SOBRE NÓS

class SobreSection extends StatelessWidget {
  const SobreSection({super.key});

  /// CARD PADRÃO
  Widget cardMembro(String imagem, String nome, String cargo) {
    return Container(
      constraints: const BoxConstraints(maxWidth: 300),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: const Color.fromARGB(255, 255, 255, 255),
        borderRadius: BorderRadius.circular(15),
        boxShadow: const [
          BoxShadow(
            color: Colors.black12,
            blurRadius: 8,
            offset: Offset(0, 4),
          )
        ],
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          CircleAvatar(
            radius: 35,
            backgroundImage: AssetImage(imagem),
          ),
          const SizedBox(height: 10),
          Text(
            nome,
            textAlign: TextAlign.center,
            style: const TextStyle(fontWeight: FontWeight.bold),
          ),
          const SizedBox(height: 5),
          Text(
            cargo,
            textAlign: TextAlign.center,
            style: const TextStyle(color: Colors.black54, fontSize: 12),
          ),
        ],
      ),
    );
  }

  /// GRID RESPONSIVO CENTRALIZADO
  Widget gridMembros(BuildContext context, List<Widget> membros) {
    double largura = MediaQuery.of(context).size.width;

    int colunas = largura < 600
        ? 1
        : largura < 900
            ? 2
            : 3;

    return Center(
      child: ConstrainedBox(
        constraints: const BoxConstraints(maxWidth: 1000),
        child: GridView.count(
          crossAxisCount: colunas,
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          crossAxisSpacing: 20,
          mainAxisSpacing: 20,
          childAspectRatio: 1,
          children: membros,
        ),
      ),
    );
  }

  /// SEÇÃO
  Widget secao(BuildContext context, String titulo, List<Widget> membros) {
    return Center(
      child: SizedBox(
        width: 300, // Define uma largura máxima para a seção
      child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const SizedBox(height: 30),
        Text(
          titulo,
          style: const TextStyle(
            fontSize: 18,
            fontWeight: FontWeight.bold,
          ),
        ),
        const SizedBox(height: 20),
        gridMembros(context, membros),
      ],
      ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Column(
     
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            /// SOBRE
            const Text(
              "Sobre a NEXA",
              style: TextStyle(
                fontSize: 32,
                fontWeight: FontWeight.bold,
              ),
            ),

            const SizedBox(height: 10),

            const Text(
              "A NEXA nasceu com o propósito de transformar a segurança do trabalho em um processo inteligente, integrado e orientado por dados.\n\n"
              "Nossa plataforma combina monitoramento inteligente, análise de dados em tempo real e conformidade normativa para garantir ambientes de trabalho mais seguros.",
              style: TextStyle(color: Colors.black54),
            ),

            const SizedBox(height: 30),

            /// CARDS DE VALORES (igual topo da imagem)
            Wrap(
              spacing: 20,
              runSpacing: 20,
              children: [
                _infoCard(Icons.flag, "Propósito",
                    "Elevar o padrão da segurança do trabalho."),
                _infoCard(Icons.lightbulb, "Inovação",
                    "Tecnologia para antecipar riscos."),
                _infoCard(Icons.verified, "Compromisso",
                    "Proteção da vida em primeiro lugar."),
              ],
            ),

            /// EQUIPE
            const SizedBox(height: 50),

            const Text(
              "Nossa Equipe",
              style: TextStyle(
                fontSize: 24,
                fontWeight: FontWeight.bold,
              ),
            ),

            /// SEÇÕES
            secao(
              context,
              "Análise e Design",
              [
                cardMembro("assets/ryan.jpg", "Ryan Donizetti Porto",
                    "Analista de Sistemas e Design"),
                cardMembro("assets/laura.png", "Laura Costa Ubaldo",
                    "Analista de Sistemas e Design"),
              ],
            ),

            secao(
              context,
              "Desenvolvimento Full Stack",
              [
                cardMembro("assets/livia.png", "Livia Bussaglia Bispo",
                    "Programadora Full Stack"),
                cardMembro("assets/bruno.png", "Bruno Donizetti Souza",
                    "Full Stack e Product Owner"),
              ],
            ),

            secao(
              context,
              "Desenvolvimento Back-End",
              [
                cardMembro("assets/nicoly.png", "Nicoly Gentina Geribola",
                    "Back-End e Scrum Master"),
                cardMembro("assets/erik.png", "Erick Donizetti Ferreira",
                    "Programador Back-End"),
                cardMembro("assets/fernanda.png",
                    "Fernanda Machado Nogueira", "Programadora Back-End"),
              ],
            ),
          ],
        );
      
    

  }

  /// CARD SUPERIOR (propósito, inovação, etc)
  Widget _infoCard(IconData icon, String titulo, String texto) {
  return Container(
    width: double.infinity,
    padding: const EdgeInsets.all(30),
    decoration: BoxDecoration(
      color: const Color.fromARGB(255, 255, 255, 255),
      borderRadius: BorderRadius.circular(10),
    ),
    child: Row(
      children: [
        // 1. Aumentar tamanho do Ícone (tamanho padrão é ~24)
        Icon(icon, color: const Color(0xFF0A66C2), size: 35),
        const SizedBox(width: 15), // Ajustado espaçamento
        Expanded(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // 2. Aumentar tamanho da fonte do Título
              Text(
                titulo,
                style: const TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 18, // <-- Aumente aqui
                ),
              ),
              const SizedBox(height: 5), // Espaçamento opcional entre título e texto
              Text(
                texto,
                style: const TextStyle(fontSize: 15),
              ),
            ],
          ),
        )
      ],
    ),
  );
  }

}


class FooterNexa extends StatelessWidget {
  const FooterNexa({super.key});

  Future<void> abrirLink(String url) async {
    final Uri uri = Uri.parse(url);

    if (!await launchUrl(
      uri,
      mode: LaunchMode.externalApplication,
    )) {
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
          /// ESQUERDA (AGORA COM ÍCONES)
          Row(
            children: [
              const Icon(Icons.security,
                  color: Color.fromARGB(255, 251, 252, 253), size: 18),
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

              /// INSTAGRAM
              IconButton(
                icon: const Icon(Icons.camera_alt,
                    color: Colors.white70, size: 18),
                onPressed: () {
                  abrirLink(
                      "https://www.instagram.com/nexa.senai/?utm_source=ig_web_button_share_sheet");
                },
              ),

              /// TIKTOK
              IconButton(
                icon: const Icon(Icons.music_note,
                    color: Colors.white70, size: 18),
                onPressed: () {
                  abrirLink(
                      "https://www.tiktok.com/@nexa.senai?_r=1&_t=ZS-95X8QioYNRU");
                },
              ),

              /// EMAIL
              IconButton(
                icon: const Icon(Icons.email,
                    color: Colors.white70, size: 18),
                onPressed: () {
                  abrirLink(Uri.encodeFull(
                    "mailto:nexa.senai@gmail.com?subject=Contato NEXA&body=Olá, gostaria de falar com vocês."
                  ));
                },
              ),
            ],
          ),

          /// CENTRO (some no mobile)
          if (!isMobile)
            Row(
              children: const [
                Icon(Icons.info_outline, color: Colors.white70, size: 16),
                SizedBox(width: 5),
                Text("Sobre",
                    style: TextStyle(color: Colors.white70, fontSize: 12)),
                SizedBox(width: 20),
                Icon(Icons.settings, color: Colors.white70, size: 16),
                SizedBox(width: 5),
                Text("Soluções",
                    style: TextStyle(color: Colors.white70, fontSize: 12)),
                SizedBox(width: 20),
                Icon(Icons.mail_outline, color: Colors.white70, size: 16),
                SizedBox(width: 5),
                Text("Contato",
                    style: TextStyle(color: Colors.white70, fontSize: 12)),
              ],
            ),

          /// DIREITA
          Row(
            children: [
              if (isMobile) ...[

                const SizedBox(width: 5),
                
                const SizedBox(width: 20),
              ],

              GestureDetector(
                onDoubleTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (_) => LoginadmPage(
                        onLogin: () {
                          Navigator.pushReplacement(
                            context,
                            MaterialPageRoute(
                              builder: (_) => Dashboard(
                                onLogout: () {
                                  Navigator.pop(context);
                                },
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
                    Icon(Icons.lock_outline,
                        color: Colors.white38, size: 14),
                    SizedBox(width: 4),
                    Text(
                      "Admin",
                      style:
                          TextStyle(color: Colors.white38, fontSize: 11),
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