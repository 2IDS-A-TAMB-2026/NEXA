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
    return Scaffold(
      backgroundColor: const Color(0xFFF4F6FA),

      //////////////////////////////////////////////////////
      /// DRAWER
      //////////////////////////////////////////////////////
      drawer: Drawer(
        backgroundColor: const Color(0xFF0F2A44),

        child: Column(
          children: [
            Container(
              height: 180,
              width: double.infinity,
              child: Stack(
                fit: StackFit.expand,
                children: [
                  Image.asset("assets/funci.webp", fit: BoxFit.cover),

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
                    bottom: 20,
                    left: 20,
                    child: Text(
                      "NEXA",
                      style: TextStyle(
                        color: Colors.white,
                        fontSize: 26,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                ],
              ),
            ),

            const SizedBox(height: 20),

            _menuItem(
              icon: Icons.dashboard,
              texto: "Dashboard",
              onTap: () => Navigator.pop(context),
            ),

            _menuItem(
              icon: Icons.camera_alt,
              texto: "Checar EPI",
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (_) => const DashboardCamera(),
                  ),
                );
              },
            ),

            _menuItem(
              icon: Icons.person,
              texto: "Perfil",
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (_) => const PerfilPage(),
                  ),
                );
              },
            ),

              const Spacer(),
              
            _menuItem(
              icon: Icons.logout,
              texto: "Sair",
              onTap: () {
                Navigator.pushAndRemoveUntil(
                  context,
                  MaterialPageRoute(
                    builder: (_) => InstitucionalPage(
                     
                    ),
                  ),
                  (route) => false,
                );
              },
            ),
          ],
        ),
      ),

      //////////////////////////////////////////////////////
      /// APP BAR
      //////////////////////////////////////////////////////
      appBar: AppBar(
        elevation: 0,
        backgroundColor: const Color(0xFF0F2A44),
         iconTheme: const IconThemeData(
    color: Colors.white, // 🔥 deixa o botão do drawer branco
  ),
        title: const Text("NEXA", style: TextStyle(color: Colors.white)),
        actions: [
          
   

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

    IconButton(
  icon: const Icon(Icons.volume_up, color: Colors.white),
  onPressed: () {
    final texto = """
    Dashboard NEXA.
    Dicas de segurança.
    Verifique seus EPIs antes de iniciar.
    Evite distrações ao operar máquinas.
    Nunca improvise equipamentos.
    "JANEIRO","FEVEREIRO","MARÇO","ABRIL","MAIO","JUNHO",
    "JULHO","AGOSTO","SETEMBRO","OUTUBRO","NOVEMBRO","DEZEMBRO"
 
    """;

    context.read<AccessibilityController>().lerTexto(texto);
  },
),
          
          IconButton(
            icon: const Icon(Icons.person, size: 25, color: Color.fromARGB(255, 235, 238, 241)),
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(builder: (_) => const PerfilPage()),
              );
            },
          ),
        ],
      ),

      //////////////////////////////////////////////////////
      /// BODY
      //////////////////////////////////////////////////////
      body:  Stack(
  children: [
    /// 🌄 IMAGEM DE FUNDO
    Positioned.fill(
      child: Image.asset(
        "assets/fundo.jpg", // 👈 sua imagem aqui
        fit: BoxFit.cover,
      ),
    ),

    /// 🌫️ OVERLAY (escurecer a imagem)
    Positioned.fill(
      child: Container(
        color: const Color.fromARGB(216, 68, 94, 209).withOpacity(0.4),
      ),
    ),
      
      
      
      
      
      
      SingleChildScrollView(
        padding: const EdgeInsets.all(20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [

            /// HEADER
            const Text(
              "Dashboard",
              style: TextStyle(
                fontSize: 32,
                fontWeight: FontWeight.bold,
                color: Color.fromARGB(255, 255, 255, 255),
              ),
            ),

            const SizedBox(height: 5),

          

            const SizedBox(height: 25),

            /// INFO FUNCIONÁRIO
             _card(
              const Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    "Dicas de Segurança",
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                      fontSize: 18,
                      color: Color(0xFF0A66C2),
                    ),
                  ),
                  SizedBox(height: 10),
                  Text("• Verifique seus EPIs antes de iniciar."),
                  Text("• Evite distrações ao operar máquinas."),
                  Text("• Nunca improvise equipamentos."),
                ],
              ),
            ),
         SizedBox(height: 20),

            /// CALENDÁRIO
            const CalendarioEPI(),

            const SizedBox(height: 20),

            
           

            const SizedBox(height: 20),

            /// RESPONSÁVEL
         
          ],
        ),
      ),
  ],
      ),

    );
  }

  //////////////////////////////////////////////////////
  /// CARD PADRÃO MELHORADO
  //////////////////////////////////////////////////////
  Widget _card(Widget child) {
    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(18),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.06),
            blurRadius: 12,
            offset: const Offset(0, 6),
          ),
        ],
      ),
      child: child,
    );
  }
}

//////////////////////////////////////////////////////
// MENU ITEM
//////////////////////////////////////////////////////
Widget _menuItem({
  required IconData icon,
  required String texto,
  required VoidCallback onTap,
}) {
  return Padding(
    padding: const EdgeInsets.symmetric(horizontal: 15, vertical: 6),
    child: InkWell(
      borderRadius: BorderRadius.circular(12),
      onTap: onTap,
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 14, horizontal: 12),
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


/// ==================
/// 📅 CALENDÁRIO
/// ==================
class CalendarioEPI extends StatefulWidget {
  const CalendarioEPI({super.key});

  @override
  State<CalendarioEPI> createState() => _CalendarioEPIState();
}

class _CalendarioEPIState extends State<CalendarioEPI> {
  int mes = DateTime.now().month;
  int ano = DateTime.now().year;

  final meses = [
    "JANEIRO","FEVEREIRO","MARÇO","ABRIL","MAIO","JUNHO",
    "JULHO","AGOSTO","SETEMBRO","OUTUBRO","NOVEMBRO","DEZEMBRO"
  ];

  @override
  Widget build(BuildContext context) {
    DateTime hoje = DateTime.now();
    DateTime primeiroDia = DateTime(ano, mes, 1);
    int diasNoMes = DateTime(ano, mes + 1, 0).day;

    int inicioSemana = primeiroDia.weekday % 7;

    return Container(
      width: double.infinity,
      padding: const EdgeInsets.all(20),
      margin: const EdgeInsets.only(bottom: 20),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(20),
        boxShadow: const [
          BoxShadow(color: Colors.black12, blurRadius: 10),
        ],
      ),
      child: Column(
        children: [

          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              IconButton(
                icon: const Icon(Icons.arrow_left),
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
                      color: Colors.red,
                    ),
                  ),
                  Text("$ano"),
                ],
              ),
              IconButton(
                icon: const Icon(Icons.arrow_right),
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

          const SizedBox(height: 10),

          const Row(
            mainAxisAlignment: MainAxisAlignment.spaceAround,
            children: [
              Text("D"), Text("S"), Text("T"),
              Text("Q"), Text("Q"), Text("S"), Text("S"),
            ],
          ),

          const SizedBox(height: 10),

          GridView.builder(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            itemCount: diasNoMes + inicioSemana,
            gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
              crossAxisCount: 7,
            ),
            itemBuilder: (context, index) {
              if (index < inicioSemana) return const SizedBox();

              int dia = index - inicioSemana + 1;
              DateTime data = DateTime(ano, mes, dia);

              Color? bolinha;

              if (data.isAfter(hoje)) {
                bolinha = null;
              } else if (data.weekday == 6 || data.weekday == 7) {
                bolinha = Colors.grey;
              } else if (dia % 3 == 0) {
                bolinha = Colors.red;
              } else {
                bolinha = Colors.green;
              }

              return Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Text(
                    "$dia",
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                      color: (dia == hoje.day &&
                              mes == hoje.month &&
                              ano == hoje.year)
                          ? Colors.red
                          : Colors.black,
                    ),
                  ),
                  const SizedBox(height: 4),
                  if (bolinha != null)
                    CircleAvatar(radius: 4, backgroundColor: bolinha),
                ],
              );
            },
          ),

          const SizedBox(height: 10),

          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: const [
              Icon(Icons.circle, color: Colors.green, size: 10),
              SizedBox(width: 5),
              Text("Correto  "),
              Icon(Icons.circle, color: Colors.red, size: 10),
              SizedBox(width: 5),
              Text("Erro  "),
              Icon(Icons.circle, color: Colors.grey, size: 10),
              SizedBox(width: 5),
              Text("Folga"),
            ],
          )
        ],
      ),
    );
  }
}