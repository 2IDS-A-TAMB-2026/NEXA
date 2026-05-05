import 'package:flutter/material.dart';

class DashboardCamera extends StatelessWidget {
  const DashboardCamera({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFF0F2A44), // 🔥 fundo dark igual web

      appBar: AppBar(
        backgroundColor: const Color(0xFF0F2A44),
        centerTitle: true,
        title: const Text(
          "Dashboard de Câmeras",
          style: TextStyle(color: Colors.white),
        ),
        iconTheme: const IconThemeData(color: Colors.white),
      ),

      drawer: _drawer(context),

     body: Stack(
  children: [
    /// 🔥 FUNDO (igual HTML)
    Positioned.fill(
      child: Image.network(
        "https://img.freepik.com/photos-premium/pour-securite-operation-travail-ingenieur-deux-ouvriers-du-batiment-tiennent-respectivement-casque-securite-jaune-blanc-the-generative-ai_28914-25222.jpg",
        fit: BoxFit.cover,
      ),
    ),

    /// 🔥 OVERLAY ESCURO (igual CSS)
    Positioned.fill(
      child: Container(
        color: Colors.black.withOpacity(0.75),
      ),
    ),

    /// CONTEÚDO
    Padding(
      padding: const EdgeInsets.all(20),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          const Text(
            "Dashboard de Câmeras",
            style: TextStyle(
              fontSize: 26,
              fontWeight: FontWeight.bold,
              color: Colors.white,
            ),
          ),

          const SizedBox(height: 20),

          Expanded(
            child: GridView.builder(
              itemCount: 12,
              gridDelegate:
                  const SliverGridDelegateWithMaxCrossAxisExtent(
                maxCrossAxisExtent: 220,
                crossAxisSpacing: 15,
                mainAxisSpacing: 15,
                childAspectRatio: 0.9,
              ),
              itemBuilder: (context, index) {
                return _cameraCard(
                  nome: "Câmera ${index + 1}",
                  ativa: index % 3 != 0,
                );
              },
            ),
          ),
        ],
      ),
    ),
  ],
),
    );
  }

  //////////////////////////////////////////////////////
  /// CARD CÂMERA (ESTILO WEB)
  //////////////////////////////////////////////////////
  Widget _cameraCard({
  required String nome,
  required bool ativa,
}) {
  return Container(
    decoration: BoxDecoration(
      color: Colors.black.withOpacity(0.6), // 🔥 fundo escuro
      borderRadius: BorderRadius.circular(20),
      boxShadow: const [
        BoxShadow(
          color: Colors.black54,
          blurRadius: 10,
        ),
      ],
    ),
    child: Column(
      children: [
        /// TELA DA CAMERA
        Expanded(
          child: Container(
            width: double.infinity,
            decoration: const BoxDecoration(
              color: Colors.black,
              borderRadius: BorderRadius.vertical(
                top: Radius.circular(20),
              ),
            ),
            child: const Center(
              child: Text(
                "Transmitindo",
                style: TextStyle(
                  color: Colors.white54,
                  fontSize: 12,
                ),
              ),
            ),
          ),
        ),

        /// INFO IGUAL HTML
        Padding(
          padding: const EdgeInsets.all(12),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              /// NOME
              Text(
                nome,
                style: const TextStyle(
                  color: Color(0xFF1D6FC7),
                  fontSize: 13,
                  fontWeight: FontWeight.bold,
                ),
              ),

              /// STATUS
              Row(
                children: [
                  Container(
                    width: 10,
                    height: 10,
                    decoration: BoxDecoration(
                      color: ativa ? Colors.green : Colors.red,
                      shape: BoxShape.circle,
                    ),
                  ),
                  const SizedBox(width: 5),
                  Text(
                    ativa ? "Ativa" : "Inativa",
                    style: const TextStyle(
                      color: Colors.white,
                      fontSize: 12,
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
      ],
    ),
  );
}

  //////////////////////////////////////////////////////
  /// DRAWER (IGUAL WEB)
  //////////////////////////////////////////////////////
  Widget _drawer(BuildContext context) {
    return Drawer(
      backgroundColor: const Color(0xFF0F2A44),
      child: Column(
        children: [
          Container(
            height: 160,
            width: double.infinity,
            decoration: const BoxDecoration(
              borderRadius: BorderRadius.only(
                bottomLeft: Radius.circular(25),
                bottomRight: Radius.circular(25),
              ),
            ),
            child: Stack(
              fit: StackFit.expand,
              children: [
                Image.asset(
                  "assets/funci.webp",
                  fit: BoxFit.cover,
                ),

                Container(
                  decoration: BoxDecoration(
                    gradient: LinearGradient(
                      colors: [
                        Colors.black.withOpacity(0.7),
                        Colors.transparent,
                      ],
                      begin: Alignment.bottomCenter,
                      end: Alignment.topCenter,
                    ),
                  ),
                ),

                const Positioned(
                  bottom: 15,
                  left: 15,
                  child: Text(
                    "NEXA",
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 22,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
              ],
            ),
          ),

          const SizedBox(height: 20),

          _menuItem(Icons.dashboard, "Dashboard"),
          _menuItem(Icons.videocam, "Câmeras"),
          _menuItem(Icons.warning, "Ocorrências"),
          _menuItem(Icons.people, "Funcionários"),
          _menuItem(Icons.security, "EPIs"),

          const Spacer(),

          _menuItem(Icons.logout, "Sair"),
        ],
      ),
    );
  }

  Widget _menuItem(IconData icon, String texto) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 15, vertical: 6),
      child: InkWell(
        borderRadius: BorderRadius.circular(12),
        onTap: () {},
        child: Container(
          padding:
              const EdgeInsets.symmetric(vertical: 14, horizontal: 12),
          child: Row(
            children: [
              Icon(icon, color: Colors.white70),
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