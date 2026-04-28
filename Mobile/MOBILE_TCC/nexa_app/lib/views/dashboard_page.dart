import 'package:flutter/material.dart';
import 'package:nexa_app/views/cameras_page.dart';
import 'package:nexa_app/views/dashboard_page_fun.dart';
import 'package:nexa_app/views/epis_page.dart';
import 'package:nexa_app/views/historico_page.dart';
import 'package:nexa_app/views/profile_page.dart';

class Dashboard extends StatefulWidget {
  final VoidCallback onLogout;

  const Dashboard({super.key, required this.onLogout});

  @override
  State<Dashboard> createState() => _DashboardState();
}

class _DashboardState extends State<Dashboard> {
  String pagina = "Dashboard";

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF4F6FA),

      //////////////////////////////////////////////////////
      /// APP BAR (necessário pro Drawer funcionar)
      //////////////////////////////////////////////////////
      appBar: AppBar(
        backgroundColor: const Color(0xFF0F2A44),
       
        title: Text(pagina),
      ),
     

      //////////////////////////////////////////////////////
      /// DRAWER (MENU LATERAL DESLIZANTE)
      //////////////////////////////////////////////////////
      drawer: Drawer(
        child: Container(
          color: const Color.fromARGB(255, 236, 237, 239),
          child: Column(
            children: [
              const SizedBox(height: 50),
              Image.asset("assets/logo.png", height: 50),
              const SizedBox(height: 30),

              menuLateral("Dashboard", Icons.dashboard),
              menuLateral("Câmeras", Icons.videocam),
              menuLateral("Registro de ocorrências", Icons.list),
              menuLateral("Perfil", Icons.person),
              menuLateral("Dashboard Funcionário", Icons.bar_chart),

              const Spacer(),

              ListTile(
                leading: const Icon(Icons.exit_to_app, color: Colors.white),
                title: const Text(
                  "Sair",
                  style: TextStyle(color: Colors.white),
                ),
                onTap: widget.onLogout,
              ),
              const SizedBox(height: 20),
            ],
          ),
        ),
      ),

      //////////////////////////////////////////////////////
      /// CONTEÚDO
      //////////////////////////////////////////////////////
      body: Padding(
        padding: const EdgeInsets.all(25),
        child: _buildPagina(),
      ),
    );
  }

  //////////////////////////////////////////////////////
  /// MENU ITEM
  //////////////////////////////////////////////////////
  Widget menuLateral(String nome, IconData icon) {
    bool selecionado = pagina == nome;

    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 10, vertical: 5),
      decoration: BoxDecoration(
        color: selecionado ? Colors.white24 : Colors.transparent,
        borderRadius: BorderRadius.circular(10),
      ),
      child: ListTile(
        leading: Icon(icon, color: Colors.white),
        title: Text(
          nome,
          style: const TextStyle(color: Colors.white),
        ),
        onTap: () {
          setState(() {
            pagina = nome;
          });

          Navigator.pop(context); // fecha o drawer
        },
      ),
    );
  }

  //////////////////////////////////////////////////////
  /// CONTROLE DE PÁGINAS
  //////////////////////////////////////////////////////
  Widget _buildPagina() {
    switch (pagina) {
      case "Câmeras":
        return const CamerasPage();
      case "Registro de ocorrências":
        return const OcorrenciaPage();
      case "Perfil":
        return const PerfilPage();
      case "Epi":
        return const EpisPage();
      case "Dashboard Funcionário":
        return const DashboardPageFun();
      default:
        return _paginaDashboard();
    }
  }

  //////////////////////////////////////////////////////
  /// DASHBOARD PRINCIPAL
  //////////////////////////////////////////////////////
  Widget _paginaDashboard() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text(
          "Dashboard",
          style: TextStyle(
            fontSize: 26,
            fontWeight: FontWeight.bold,
            color: Color(0xFF0F2A44),
          ),
        ),
        const SizedBox(height: 5),
        const Text(
          "Bem-vindo, Administrador",
          style: TextStyle(
            fontSize: 16,
            color: Colors.grey,
          ),
        ),
        const SizedBox(height: 30),

        Row(
          children: [
            metricCard(
              "Funcionários Ativos",
              "148",
              "Em 12 zonas monitoradas",
              Icons.people,
              Colors.orange,
            ),
            const SizedBox(width: 20),
            metricCard(
              "Taxa de Conformidade",
              "94.2%",
              "Últimas 24h",
              Icons.check_circle,
              Colors.green,
            ),
          ],
        ),
        const SizedBox(height: 20),

        Row(
          children: [
            metricCard(
              "Violações Hoje",
              "12",
              "3 críticas pendentes",
              Icons.warning,
              Colors.red,
            ),
            const SizedBox(width: 20),
            metricCard(
              "Câmeras Online",
              "24/26",
              "2 em manutenção",
              Icons.videocam,
              Colors.blue,
            ),
          ],
        ),
      ],
    );
  }

  //////////////////////////////////////////////////////
  /// CARD DE MÉTRICAS
  //////////////////////////////////////////////////////
  Widget metricCard(
    String titulo,
    String valor,
    String subtitulo,
    IconData icon,
    Color cor,
  ) {
    return Expanded(
      child: Container(
        padding: const EdgeInsets.all(20),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(15),
          boxShadow: const [
            BoxShadow(color: Colors.black12, blurRadius: 10),
          ],
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  titulo,
                  style: const TextStyle(fontWeight: FontWeight.w600),
                ),
                Icon(icon, color: cor),
              ],
            ),
            const SizedBox(height: 15),
            Text(
              valor,
              style: const TextStyle(
                fontSize: 28,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 5),
            Text(
              subtitulo,
              style: const TextStyle(color: Colors.grey),
            ),
          ],
        ),
      ),
    );
    
  }
}