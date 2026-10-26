import 'package:flutter/material.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import 'package:nexa_app/views/dashboard_page_fun.dart';
import 'package:nexa_app/views/login_page.dart';
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

  final acess = context.watch<AccessibilityController>();

  return AppBar(
    title: Row(
      children: [
        Image.asset('assets/logo.nexa.png', height: 30),
        const SizedBox(width: 10),
        Text(
          "NEXA",
          style: TextStyle(
            color: acess.darkMode ? Colors.white : const Color(0xFF161616),
            fontWeight: FontWeight.bold,
          ),
        ),
      ],
    ),
    backgroundColor: acess.darkMode
        ? const Color(0xFF1A2B4C)
        : const Color(0xFFF8F9FA),
    foregroundColor: acess.darkMode ? Colors.white : const Color(0xFF161616),
    actions: [
      Row(
        children: [
          /// 🔠 AUMENTAR FONTE
          IconButton(
            icon: const Icon(
              Icons.text_increase,
              size: 25,
              color: Color.fromARGB(255, 6, 74, 143),
            ),
            onPressed: () {
              context.read<AccessibilityController>().aumentarFonte();
            },
          ),

          /// 🔡 DIMINUIR FONTE
          IconButton(
            icon: const Icon(
              Icons.text_decrease,
              size: 25,
              color: Color.fromARGB(255, 4, 64, 124),
            ),
            onPressed: () {
              context.read<AccessibilityController>().diminuirFonte();
            },
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
                  builder: (_) => LoginPage(
                    onLogin: () {
                      Navigator.pushReplacement(
                        context,
                        MaterialPageRoute(builder: (_) => DashboardPageFun()),
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
