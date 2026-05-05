import 'package:flutter/material.dart';
import 'package:nexa_app/controllers/acessibility_controller.dart';
import 'package:nexa_app/views/cadastro%20_cameras.dart';
import 'package:nexa_app/views/cadastro_setor.dart';
import 'package:nexa_app/views/cameras_page.dart';
import 'package:nexa_app/views/dashboard_page_fun.dart';
import 'package:nexa_app/views/gerenciamento.epi.dart';
import 'package:nexa_app/views/historico_page.dart';
import 'package:nexa_app/views/profile_adm_page.dart';
import 'package:nexa_app/views/profile_page.dart';

import 'dart:math';

import 'package:nexa_app/views/register_page.dart';
import 'package:provider/provider.dart';


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
      /// APP BAR
      //////////////////////////////////////////////////////
    appBar: AppBar(
 backgroundColor: const Color(0xFF0F2A44),
  iconTheme: IconThemeData(
      color: Colors.white,
  ),

  title: Text(
     "NEXA",
    style: TextStyle(color: Colors.white),
  ),

  actions: [
    /// 🔊 LER
    

    /// 🔠 AUMENTAR FONTE
    IconButton(
      icon: const Icon(Icons.text_increase,
      size: 25,
        color:   const Color.fromARGB(255, 253, 254, 255),
        
      ),
      onPressed: () {
        context.read<AccessibilityController>().aumentarFonte();
      },
    ),

    /// 🔡 DIMINUIR FONTE
    IconButton(
      icon: const Icon(Icons.text_decrease,
      size: 25,
        color:   const Color.fromARGB(255, 253, 254, 255),
        
      ),
      onPressed: () {
        context.read<AccessibilityController>().diminuirFonte();
      },
    ),

  

    /// 👤 PERFIL
    IconButton(
      icon: Icon(
        Icons.person,
        size: 25,
        color:   const Color.fromARGB(255, 253, 254, 255),
        ),
      
      onPressed: () {
        Navigator.push(
          context,
          MaterialPageRoute(builder: (_) => const PerfiladmPage()),
        );
      },
    ),

    const SizedBox(width: 10),
  ],
),
      //////////////////////////////////////////////////////
      /// DRAWER
      //////////////////////////////////////////////////////
      drawer: Drawer(
        backgroundColor: const Color(0xFF0F2A44),
        child: Container(
          color: const Color(0xFF0F2A44),
          child: ListView(
  padding: EdgeInsets.zero,
  children: [
    const SizedBox(height: 50),
    Image.asset("assets/logo_branco.png", height: 50),
    const SizedBox(height: 30),

    menuLateral("Dashboard", Icons.dashboard),
    menuLateral("Câmeras", Icons.videocam),
    menuLateral("Registro de Ocorrências", Icons.list),
    menuLateral("Cadastro de Funcionários", Icons.manage_accounts),
    menuLateral("Gerenciamento de EPI's", Icons.health_and_safety),
    menuLateral("Cadastro de Setores", Icons.edit),
    menuLateral("Cadastro de Câmeras", Icons.videocam),

    const SizedBox(height: 20),

    ListTile(
      leading: const Icon(Icons.logout, color: Colors.white),
      title: const Text(
        "Sair",
        style: TextStyle(color: Colors.white),
      ),
      onTap: () {
        widget.onLogout();
      },
    ),

    const SizedBox(height: 20),
  ],
),
        ),
      ),

      //////////////////////////////////////////////////////
      /// CONTEÚDO
      //////////////////////////////////////////////////////
      body: Stack(
  children: [
    /// 🌄 IMAGEM DE FUNDO
    Positioned.fill(
      child: Image.asset(
        "assets/fundo.jpg",
        fit: BoxFit.cover,
      ),
    ),

    /// 🌫️ OVERLAY (escurece a imagem)
    Positioned.fill(
      child: Container(
        color: const Color.fromARGB(255, 59, 76, 230).withOpacity(0.4),
      ),
    ),

      
      
      
       Padding(
        padding: const EdgeInsets.all(25),
        child: _buildPagina(),
      ),
  ],
      ),
    );
  }

  //////////////////////////////////////////////////////
  /// MENU
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
        title: Text(nome, style: const TextStyle(color: Colors.white)),
        onTap: () {
          setState(() {
            pagina = nome;
          });
          Navigator.pop(context);
        },
      ),
    );
  }

  //////////////////////////////////////////////////////
  /// PÁGINAS
  //////////////////////////////////////////////////////
  Widget _buildPagina() {
    switch (pagina) {
      case "Câmeras":
        return const CamerasPage();

      case "Registro de Ocorrências":
        return const OcorrenciaPage();
     
      case "Epi":
        return const CadastroEPIPage();
        
      case "Gerenciamento de EPI's":
        return const CadastroEPIPage();

      case "Cadastro de Setores":
        return const CadastroSetorPage();


        case "Cadastro de Câmeras":
        return const CadastroCameraPage();

        case "Cadastro de Funcionários":
        return const RegisterPage();
      
      

        
      default:
        return _paginaDashboard();
    }
  }

  //////////////////////////////////////////////////////
  /// DASHBOARD
  //////////////////////////////////////////////////////
  Widget _paginaDashboard() {
    return SingleChildScrollView(
         child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        //////////////////////////////////////////////////////
        /// TOPO (CORRIGIDO)
        //////////////////////////////////////////////////////
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: const [
            Text(
              "Dashboard",
              style: TextStyle(
                fontSize: 28,
                fontWeight: FontWeight.bold,
                color: Color.fromARGB(255, 255, 255, 255),
              ),
            ),
            Text(
              "Bem-vindo, Administrador",
              style: TextStyle(color: Color.fromARGB(221, 255, 255, 255)),
            ),
          ],
        ),

        const SizedBox(height: 30),

        //////////////////////////////////////////////////////
        /// CARDS
        //////////////////////////////////////////////////////
        Row(
          children: [
            metricCard("Pessoas analisadas hoje", "0", Colors.blue),
            const SizedBox(width: 20),
            metricCard("Conformidade", "30%", Colors.blue),
            const SizedBox(width: 20),
            metricCard("Alertas ativos", "0", Colors.red),
            const SizedBox(width: 20),
            metricCard("Câmeras ativas", "3", Colors.blue),
          ],
        ),

        const SizedBox(height: 30),

                    const Text(
              "Gráficos- Dados sobre uso dos EPIs",
              style: TextStyle(
                fontSize: 22,
                fontWeight: FontWeight.bold,
                color: Color.fromARGB(255, 255, 255, 255),
              ),
            ),

            const SizedBox(height: 20),

            graficoEpi(),

            const SizedBox(height: 30),

          graficoPizzaFuncionarios(),
        //////////////////////////////////////////////////////
        /// ALERTAS
        //////////////////////////////////////////////////////
     
      
      ],
    ),
    );

      }

  //////////////////////////////////////////////////////
  /// CARD CORRIGIDO
  //////////////////////////////////////////////////////
  Widget metricCard(String titulo, String valor, Color corValor) {
    return Expanded(
      child: Container(
        padding: const EdgeInsets.all(20),
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(15),
          boxShadow: const [
            BoxShadow(
              color: Colors.black12,
              blurRadius: 10,
              offset: Offset(0, 5),
            ),
          ],
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              titulo,
              style: const TextStyle(
                color: Colors.black54,
                fontWeight: FontWeight.w600,
              ),
            ),
            const SizedBox(height: 10),
            Text(
              valor,
              style: TextStyle(
                fontSize: 28,
                fontWeight: FontWeight.bold,
                color: corValor,
              ),
            ),
          ],
        ),
      ),
    );
  }

  

 Widget graficoEpi() {
  final dados = [
    {"label": "Conforme", "valor": 20.0, "cor": const Color.fromARGB(255, 37, 205, 43)},
    {"label": "Não conforme", "valor": 10.0, "cor": const Color.fromARGB(255, 222, 68, 57)},
    {"label": "Parcial", "valor": 10.0, "cor": Colors.orange},
  ];

 
  double totalFuncionarios = 40;

  double maxValor = totalFuncionarios;

  return Container(
    padding: const EdgeInsets.all(20),
    decoration: BoxDecoration(
      color: Colors.white,
      borderRadius: BorderRadius.circular(20),
      boxShadow: const [
        BoxShadow(
          color: Colors.black12,
          blurRadius: 20,
          offset: Offset(0, 8),
        ),
      ],
    ),
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text(
          "Uso de EPIs",
          style: TextStyle(
            fontSize: 20,
            fontWeight: FontWeight.bold,
            color: Color(0xFF0F2A44),
          ),
        ),

        const SizedBox(height: 25),
SizedBox(
  height: 260,
  child: LayoutBuilder(
    builder: (context, constraints) {
      double alturaMax = constraints.maxHeight - 40;

      return Row(
        children: [
          eixoY(maxValor),
          const SizedBox(width: 6),
          Expanded(
            child: Stack(
              children: [
                gridFundo(),
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                  crossAxisAlignment: CrossAxisAlignment.end,
                  children: dados.map((item) {
                    return Expanded(
                      child: barraTop(
                        label: item["label"] as String,
                        valor: item["valor"] as double,
                        max: maxValor,
                        cor: item["cor"] as Color,
                        totalFuncionarios: totalFuncionarios,
                        alturaMax: alturaMax, // 👈 NOVO
                        isMaior: item["valor"] ==
                            dados.map((e) => e["valor"]).reduce((a, b) =>
                                (a as double) > (b as double) ? a : b),
                      ),
                    );
                  }).toList(),
                ),
              ],
            ),
          ),
        ],
      );
    },
  ),
),
      ],
    ),
  );
}

Widget gridFundo() {
  return Column(
    mainAxisAlignment: MainAxisAlignment.spaceBetween,
    children: List.generate(
      5,
      (index) => Container(
        height: 1,
        color: Colors.grey.withOpacity(0.2),
      ),
    ),
  );
}

Widget eixoY(double maxValor) {
  int divisoes = 5;
  double passo = maxValor / (divisoes - 1);

  return Column(
    mainAxisAlignment: MainAxisAlignment.spaceBetween,
    children: List.generate(divisoes, (index) {
      double valor = maxValor - (passo * index);

      return Text(
        valor.toInt().toString(),
        style: const TextStyle(
          fontSize: 10,
          color: Colors.black54,
        ),
      );
    }),
  );
}

 
Widget barraTop({
  required String label,
  required double valor,
  required double max,
  required Color cor,
  required double totalFuncionarios,
  required bool isMaior,
  required double alturaMax, 

}) {
 

  return TweenAnimationBuilder<double>(
    tween: Tween(begin: 0, end: valor),
    duration: const Duration(milliseconds: 900),
    curve: Curves.easeOutCubic,
    builder: (context, value, child) {
      double altura = (value / max) * alturaMax;

      // PORCENTAGEM REAL BASEADA NO TOTAL
      double porcentagem = (valor / totalFuncionarios) * 100;

      return Column(
        mainAxisAlignment: MainAxisAlignment.end,
        children: [
          Column(
            children: [
              Text(
                value.toInt().toString(),
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: isMaior ? 18 : 14,
                  color: cor,
                ),
              ),
              Text(
                "${porcentagem.toStringAsFixed(0)}%",
                style: TextStyle(
                  fontSize: isMaior ? 13 : 11,
                  fontWeight: isMaior ? FontWeight.bold : FontWeight.normal,
                  color: cor,
                ),
              ),
            ],
          ),

          const SizedBox(height: 6),

          AnimatedContainer(
            duration: const Duration(milliseconds: 500),
            width: isMaior ? 32 : 24,
            height: altura,
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(14),
              gradient: LinearGradient(
                colors: [
                  cor.withOpacity(0.5),
                  cor,
                ],
                begin: Alignment.bottomCenter,
                end: Alignment.topCenter,
              ),
              boxShadow: [
                BoxShadow(
                  color: cor.withOpacity(0.5),
                  blurRadius: isMaior ? 16 : 6,
                  offset: const Offset(0, 4),
                )
              ],
            ),
          ),

          const SizedBox(height: 8),

          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 4),
            child: Text(
              label,
              overflow: TextOverflow.ellipsis,
              textAlign: TextAlign.center,
              style: TextStyle(
                fontSize: 13,
                fontWeight: isMaior ? FontWeight.bold : FontWeight.w500,
                color: cor,
              ),
            ),
          ),
        ],
      );
    },
  );
}
Widget graficoPizzaFuncionarios() {
  double totalFuncionarios = 40;
  double verificados = 30;
  double faltaram = totalFuncionarios - verificados;

  double porcentagem = (verificados / totalFuncionarios) * 100;

  return Container(
    padding: const EdgeInsets.all(20),
    decoration: BoxDecoration(
      color: Colors.white,
      borderRadius: BorderRadius.circular(20),
      boxShadow: const [
        BoxShadow(
          color: Colors.black12,
          blurRadius: 20,
          offset: Offset(0, 8),
        ),
      ],
    ),
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Text(
          "Verificação de Funcionários",
          style: TextStyle(
            fontSize: 20,
            fontWeight: FontWeight.bold,
            color: Color(0xFF0F2A44),
          ),
        ),

        const SizedBox(height: 25),

        Center(
          child: Stack(
            alignment: Alignment.center,
            children: [
              SizedBox(
                height: 220,
                width: 220,
                child: CustomPaint(
                  painter: PizzaPainter(
                    verificados: verificados,
                    faltaram: faltaram,
                  ),
                ),
              ),

             
              Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Text(
                    "${porcentagem.toStringAsFixed(0)}%",
                    style: const TextStyle(
                      fontSize: 28,
                      fontWeight: FontWeight.bold,
                      color: Color(0xFF0F2A44),
                    ),
                  ),
                  const Text(
                    "Verificados",
                    style: TextStyle(color: Colors.black54),
                  ),
                ],
              )
            ],
          ),
        ),

        const SizedBox(height: 20),

        Row(
          mainAxisAlignment: MainAxisAlignment.spaceEvenly,
          children: [
            legendaItem(Colors.green, "Verificados"),
            legendaItem(Colors.red, "Faltaram"),
          ],
        ),
      ],
    ),
  );
}




Widget legendaItem(Color cor, String texto) {
  return Row(
    children: [
      Container(
        width: 12,
        height: 12,
        decoration: BoxDecoration(
          color: cor,
          borderRadius: BorderRadius.circular(4),
        ),
      ),
      const SizedBox(width: 6),
      Text(texto),
    ],
  );
}


}




class PizzaPainter extends CustomPainter {
  final double verificados;
  final double faltaram;

  PizzaPainter({
    required this.verificados,
    required this.faltaram,
  });

  @override
  void paint(Canvas canvas, Size size) {
    final total = verificados + faltaram;
    if (total == 0) return;

    final rect = Rect.fromLTWH(0, 0, size.width, size.height);

    final paint = Paint()
      ..style = PaintingStyle.stroke 
      ..strokeWidth = 30 
      ..strokeCap = StrokeCap.round; 

    double startAngle = -pi / 2;

    // VERIFICADOS
    final sweepVerificados = (verificados / total) * 2 * pi;
    paint.color = const Color.fromARGB(255, 25, 237, 32);
    canvas.drawArc(rect, startAngle, sweepVerificados, false, paint);

    // FALTARAM
    final sweepFaltaram = (faltaram / total) * 2 * pi;
    paint.color = Colors.red;
    canvas.drawArc(
      rect,
      startAngle + sweepVerificados,
      sweepFaltaram,
      false,
      paint,
    );
  }

  @override
  bool shouldRepaint(covariant CustomPainter oldDelegate) => true;
}