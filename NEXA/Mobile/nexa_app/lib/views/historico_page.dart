import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

/// APP
class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      debugShowCheckedModeBanner: false,
      home: OcorrenciaPage(),
    );
  }
}

/// ================= PAGE =================
class OcorrenciaPage extends StatelessWidget {
  const OcorrenciaPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.transparent, // 🔥 SEM FUNDO BRANCO

      body: SafeArea(
        child: Padding(
          padding: const EdgeInsets.all(20),

          child: ListView(
            children: [

              /// 🔷 HEADER
              Row(
                children: const [
                  Icon(Icons.warning_amber_rounded,
                      color: Color.fromARGB(255, 253, 254, 255), size: 28),
                  SizedBox(width: 10),
                  Text(
                    "Ocorrências",
                    style: TextStyle(
                      fontSize: 26,
                      fontWeight: FontWeight.bold,
                      color: Color.fromARGB(255, 255, 255, 255),
                    ),
                  ),
                ],
              ),

              const SizedBox(height: 5),

              const Text(
                "Monitoramento de eventos de segurança",
                style: TextStyle(color: Color.fromARGB(255, 255, 255, 255)),
              ),

              const SizedBox(height: 20),

              /// 🔥 CARDS
              ocorrenciaCard(
                tipo: "VIOLAÇÃO",
                camera: "Cam 03",
                funcionario: "Carlos Silva",
                local: "Zona A",
                data: "30/04/2026",
                hora: "14:32",
                epis: [
                  epiItem("Capacete", false),
                  epiItem("Luvas", false),
                ],
                cor: Colors.red,
                icone: Icons.warning_amber_rounded,
              ),

              ocorrenciaCard(
                tipo: "CONFORME",
                camera: "Cam 02",
                funcionario: "Ana Oliveira",
                local: "Zona B",
                data: "30/04/2026",
                hora: "15:10",
                epis: [
                  epiItem("Capacete", true),
                  epiItem("Luvas", true),
                ],
                cor: Colors.green,
                icone: Icons.check_circle,
              ),

              ocorrenciaCard(
                tipo: "PARCIAL",
                camera: "Cam 01",
                funcionario: "Marcos Pereira",
                local: "Zona C",
                data: "30/04/2026",
                hora: "16:05",
                epis: [
                  epiItem("Capacete", true),
                  epiItem("Luvas", false),
                ],
                cor: Colors.orange,
                icone: Icons.error_outline,
              ),
            ],
          ),
        ),
      ),
    );
  }

  /// 🔥 CARD COMPLETO (estilo web)
  Widget ocorrenciaCard({
    required String tipo,
    required String camera,
    required String funcionario,
    required String local,
    required String data,
    required String hora,
    required List<Widget> epis,
    required Color cor,
    required IconData icone,
  }) {
    return Container(
      margin: const EdgeInsets.only(bottom: 15),
      padding: const EdgeInsets.all(18),

      decoration: BoxDecoration(
        color: Colors.white, // 🔥 SOMENTE O CARD É BRANCO
        borderRadius: BorderRadius.circular(14),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.08),
            blurRadius: 10,
            offset: const Offset(0, 4),
          )
        ],
        border: Border(
          left: BorderSide(color: cor, width: 5),
        ),
      ),

      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [

          /// 🔷 HEADER DO CARD
          Row(
            children: [
              Icon(icone, color: cor, size: 22),
              const SizedBox(width: 6),

              Text(
                "$tipo - ",
                style: TextStyle(
                  color: cor,
                  fontWeight: FontWeight.bold,
                ),
              ),

              Container(
                padding:
                    const EdgeInsets.symmetric(horizontal: 8, vertical: 3),
                decoration: BoxDecoration(
                  color: Colors.black12,
                  borderRadius: BorderRadius.circular(8),
                ),
                child: Text(camera),
              ),
            ],
          ),

          const SizedBox(height: 10),

          /// 🔥 GRID (igual web)
          Row(
            children: [
              Expanded(child: Text("Funcionário: $funcionario")),
              Expanded(child: Text("Local: $local")),
            ],
          ),

          const SizedBox(height: 4),

          Row(
            children: [
              Expanded(child: Text("Data: $data")),
              Expanded(child: Text("Hora: $hora")),
            ],
          ),

          const SizedBox(height: 12),

          /// 🔥 EPIs
          Wrap(
            spacing: 8,
            children: epis,
          ),
        ],
      ),
    );
  }

  /// 🔥 TAG EPI
  Widget epiItem(String nome, bool ok) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      decoration: BoxDecoration(
        color: ok ? Colors.green.shade50 : Colors.red.shade50,
        borderRadius: BorderRadius.circular(10),
      ),
      child: Text(
        nome,
        style: TextStyle(
          color: ok ? Colors.green : Colors.red,
          fontSize: 12,
        ),
      ),
    );
  }
}