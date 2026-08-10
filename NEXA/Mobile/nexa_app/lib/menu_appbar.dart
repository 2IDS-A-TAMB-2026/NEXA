import 'package:flutter/material.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import 'package:nexa_app/views/dashboard_page_fun.dart';
import 'package:nexa_app/views/institucional_page.dart';
import 'package:nexa_app/views/login_page.dart';
import 'package:nexa_app/views/dashboard_page.dart';
import 'package:nexa_app/views/loginadm_page.dart';
import 'package:provider/provider.dart';

PreferredSizeWidget menuAppBar(BuildContext context) {
  Widget botao(String texto, VoidCallback onPressed) {
    return Container(
      decoration: BoxDecoration(
        color: const Color(0xFF0A66C2),
        borderRadius: BorderRadius.circular(30),
      ),
      child: TextButton(
        onPressed: onPressed,
        child: Text(texto, style: const TextStyle(color: Colors.white)),
      ),
    );
  }

  return AppBar(
    title: Row(
      children: [
        Image.asset('assets/logo.nexa.png', height: 30),
        const SizedBox(width: 10),
        const Text("NEXA"),
      ],
    ),
    backgroundColor: const Color(0xFFF8F9FA),
    actions: [
      Row(
        children: [

            /// 🔠 AUMENTAR FONTE
    IconButton(
      icon: const Icon(Icons.text_increase,
      size: 25,
        color:   Color.fromARGB(255, 6, 74, 143),
        
      ),
      onPressed: () {
        context.read<AccessibilityController>().aumentarFonte();
      },
    ),

    /// 🔡 DIMINUIR FONTE
    IconButton(
      icon: const Icon(Icons.text_decrease,
      size: 25,
        color:   Color.fromARGB(255, 4, 64, 124),
        
      ),
      onPressed: () {
        context.read<AccessibilityController>().diminuirFonte();
      },
    ),


     IconButton(
  icon: const Icon(Icons.volume_up, color: Color.fromARGB(255, 4, 64, 124)),
  onPressed: () {
    final texto = """
NEXA.

Safety at the Core.

A NEXA é uma plataforma inteligente de segurança do trabalho, unindo tecnologia, dados e automação para proteger pessoas e operações.

Botões principais:
Acesse o app.
Sobre nós.

Missão, Visão e Valores.
Missão: Transformar a segurança do trabalho em inteligência, promovendo ambientes mais seguros e eficientes.
Visão: Ser referência global em soluções tecnológicas de segurança e compliance corporativo.
Valores: Ética, inovação, responsabilidade social, transparência e compromisso com a vida.

Soluções.
Monitoramento de EPIs.
Relatórios inteligentes.
Compliance global.
Alertas em tempo real.
Centralização de dados.
Gestão de riscos.

Visão Computacional.
A visão computacional é um campo da inteligência artificial que permite analisar imagens e detectar uso de EPIs.

Sobre a NEXA.
Plataforma focada em segurança do trabalho com tecnologia e dados.

Equipe.
Análise e design.
Desenvolvimento full stack.
Desenvolvimento back-end.

Rodapé.
Links e redes sociais da NEXA.
""";

context.read<AccessibilityController>().lerTexto(texto);  },
),
          /// HOME
         
      botao("Entrar", () {
  Navigator.push(
    context,
    MaterialPageRoute(
      builder: (_) => LoginPage(
        onLogin: () {
          Navigator.pushReplacement(
            context,
            MaterialPageRoute(
              builder: (_) => const DashboardPageFun(),
            ),
          );
        },
        onVoltar: () => Navigator.pop(context),
      ),
    ),
  );
}),

          const SizedBox(width: 10),

          /// 🔥 BOTÃO ADMIN ESCONDIDO
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
                    onVoltar: () => Navigator.pop(context),
                  ),
                ),
              );
            },
            child: const SizedBox(width: 30, height: 30),
          ),
        ],
      ),
    ],
  );
}