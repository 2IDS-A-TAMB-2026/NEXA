import 'package:flutter/material.dart';
import 'package:nexa_app/views/institucional_page.dart';
import 'package:nexa_app/views/profile_page.dart';
import 'package:nexa_app/views/dashboard_page_fun.dart';

class DashboardCamera extends StatelessWidget {
  const DashboardCamera({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.black, // Tela principal de visualização da câmera

      appBar: AppBar(
        backgroundColor: const Color.fromARGB(255, 244, 244, 245),
        centerTitle: true,
        title: const Text(
          "Câmeras",
          style: TextStyle(color: Color.fromARGB(255, 60, 140, 233), fontWeight: FontWeight.w600),
        ),
        iconTheme: const IconThemeData(color: Color.fromARGB(255, 38, 143, 228)),
      ),

      drawer: _drawer(context),

      body: SafeArea(
        child: Stack(
          children: [
            // 1. FEED DE VÍDEO DA CÂMERA
            const Center(
              child: Text(
                "Feed de Transmissão ao Vivo",
                style: TextStyle(color: Colors.white24, fontSize: 16),
              ),
            ),

            // 2. STATUS "TRANSMITINDO"
            Padding(
              padding: const EdgeInsets.all(16.0),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.end,
                children: [
                  Row(
                    children: [
                      Container(
                        width: 8,
                        height: 8,
                        decoration: const BoxDecoration(
                          color: Colors.green,
                          shape: BoxShape.circle,
                        ),
                      ),
                      const SizedBox(width: 6),
                      const Text(
                        "Transmitindo",
                        style: TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),

            // 3. BOTÃO "ANALISAR EPI"
            Positioned(
              bottom: 24,
              left: 0,
              right: 0,
              child: Center(
                child: ElevatedButton.icon(
                  onPressed: () {
                    // Ação de analisar EPI
                  },
                  icon: const Icon(Icons.security, color: Colors.white),
                  label: const Text(
                    "ANALISAR EPI",
                    style: TextStyle(
                      color: Colors.white,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFF0075E3),
                    padding: const EdgeInsets.symmetric(
                      horizontal: 28,
                      vertical: 14,
                    ),
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
    );
  }

  //////////////////////////////////////////////////////
  /// DRAWER (EXATAMENTE IGUAL À SUA IMAGEM)
  //////////////////////////////////////////////////////
  Widget _drawer(BuildContext context) {
    return Drawer(
      backgroundColor: const Color(0xFF071C30),
      child: Stack(
        children: [
          // 🖼️ IMAGEM APENAS NO CANTO INFERIOR DO MENU
          Positioned(
            bottom: 0,
            left: 0,
            right: 0,
            height: 380, // Altura da imagem no fundo inferior
            child: Image.asset(
              "assets/funci.png",
              fit: BoxFit.cover,
              alignment: Alignment.bottomCenter,
              errorBuilder: (context, error, stackTrace) {
                return const SizedBox(); // Fallback caso a imagem não exista
              },
            ),
          ),

          // 🎨 GRADIENTE DE FUSÃO (Faz a imagem transicionar suavemente pro azul)
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
                    const Color(0xFF071C30), // Azul sólido no topo
                    const Color(
                      0xFF071C30,
                    ).withOpacity(0.65), // Transparência sobre o funcionário
                  ],
                ),
              ),
            ),
          ),

          // 📄 CONTEÚDO DO MENU
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
                  icon: Icons.show_chart,
                  texto: "Dashboard",
                  isSelected: false,
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
                  icon: Icons.videocam,
                  texto: "Análise de EPI",
                  isSelected: true, // Item ativo selecionado
                  onTap: () {
                    Navigator.pop(context);
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
                  icon: Icons.person,
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

                // BOTÃO INFERIOR: SAIR DO SISTEMA (Com contorno igual da imagem)
                Padding(
                  padding: const EdgeInsets.all(20.0),
                  child: OutlinedButton(
                    onPressed: () {
                      Navigator.pushAndRemoveUntil(
                        context,
                        MaterialPageRoute(builder: (_) => InstitucionalPage()),
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
    );
  }

  // WIDGET AUXILIAR DO ITEM DE MENU
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
}
