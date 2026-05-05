import 'package:flutter/material.dart';
import 'login_page.dart';

class NovaSenhaPage extends StatefulWidget {
  const NovaSenhaPage({super.key});

  @override
  State<NovaSenhaPage> createState() => _NovaSenhaPageState();
}

class _NovaSenhaPageState extends State<NovaSenhaPage> {
  final senhaController = TextEditingController();
  final confirmarController = TextEditingController();

  String mensagem = "";

  @override
  Widget build(BuildContext context) {
    final largura = MediaQuery.of(context).size.width;
    final isMobile = largura < 800;
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Scaffold(
      appBar: AppBar(
        backgroundColor: const Color(0xFF0A66C2),
        iconTheme: const IconThemeData(color: Colors.white),
        title: const Text(
          "Nova Senha",
          style: TextStyle(color: Colors.white),
        ),
      ),
      backgroundColor:
          isDark ? const Color(0xFF0D1117) : const Color(0xFFF4F6FA),
      body: isMobile
          ? _mobileLayout(context, isDark)
          : _desktopLayout(context, isDark),
    );
  }

  //////////////////////////////////////////////////////
  /// MOBILE
  //////////////////////////////////////////////////////
  Widget _mobileLayout(BuildContext context, bool isDark) {
    return SingleChildScrollView(
      child: Column(
        children: [
          /// TOPO
          Container(
            width: double.infinity,
            padding: const EdgeInsets.only(top: 60, bottom: 40),
            decoration: const BoxDecoration(
              gradient: LinearGradient(
                colors: [Color(0xFF0A66C2), Color(0xFF003C8F)],
              ),
              borderRadius: BorderRadius.only(
                bottomLeft: Radius.circular(30),
                bottomRight: Radius.circular(30),
              ),
            ),
            child: Column(
              children: [
                Image.asset("assets/logo_branco.png", height: 90),
                const SizedBox(height: 10),
                const Text(
                  "Nova Senha",
                  style: TextStyle(
                      fontSize: 26,
                      fontWeight: FontWeight.bold,
                      color: Colors.white),
                ),
              ],
            ),
          ),

          /// FORM
          Transform.translate(
            offset: const Offset(0, -30),
            child: Container(
              margin: const EdgeInsets.symmetric(horizontal: 20),
              padding: const EdgeInsets.all(25),
              decoration: BoxDecoration(
                color: isDark ? const Color(0xFF161B22) : Colors.white,
                borderRadius: BorderRadius.circular(20),
                boxShadow: const [
                  BoxShadow(color: Colors.black12, blurRadius: 10)
                ],
              ),
              child: Column(
                children: [
                  const Text(
                    "Digite sua nova senha",
                    style: TextStyle(
                        fontSize: 16, fontWeight: FontWeight.bold),
                  ),

                  const SizedBox(height: 20),

                  TextField(
                    controller: senhaController,
                    obscureText: true,
                    decoration: const InputDecoration(
                      labelText: "Nova senha",
                      border: OutlineInputBorder(),
                    ),
                  ),

                  const SizedBox(height: 20),

                  TextField(
                    controller: confirmarController,
                    obscureText: true,
                    decoration: const InputDecoration(
                      labelText: "Confirmar senha",
                      border: OutlineInputBorder(),
                    ),
                  ),

                  const SizedBox(height: 20),

                  ElevatedButton.icon(
                    onPressed: _resetarSenha,
                    icon: const Icon(Icons.lock_reset, color: Colors.white),
                    label: const Text(
                      "Redefinir senha",
                      style: TextStyle(color: Colors.white),
                    ),
                    style: ElevatedButton.styleFrom(
                      minimumSize: const Size(double.infinity, 50),
                      backgroundColor: const Color(0xFF0A66C2),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(30),
                      ),
                    ),
                  ),

                  const SizedBox(height: 15),

                  Text(
                    mensagem,
                    style: const TextStyle(color: Colors.red),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  //////////////////////////////////////////////////////
  /// DESKTOP
  //////////////////////////////////////////////////////
  Widget _desktopLayout(BuildContext context, bool isDark) {
    return Row(
      children: [
        Expanded(
          child: Container(
            decoration: const BoxDecoration(
              gradient: LinearGradient(
                colors: [Color(0xFF0A66C2), Color(0xFF003C8F)],
              ),
            ),
            child: Center(
              child: Image.asset("assets/logo_branco.png", height: 150),
            ),
          ),
        ),

        Expanded(
          child: Center(
            child: Container(
              width: 420,
              padding: const EdgeInsets.all(35),
              decoration: BoxDecoration(
                color: isDark ? const Color(0xFF161B22) : Colors.white,
                borderRadius: BorderRadius.circular(15),
                boxShadow: const [
                  BoxShadow(color: Colors.black12, blurRadius: 10)
                ],
              ),
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Image.asset("assets/logo_branco.png", height: 60),

                  const SizedBox(height: 10),

                  Text(
                    "Nova Senha",
                    style: TextStyle(
                      fontSize: 24,
                      fontWeight: FontWeight.bold,
                      color:
                          isDark ? Colors.white : const Color(0xFF1F3C5B),
                    ),
                  ),

                  const SizedBox(height: 20),

                  const Text(
                    "Digite sua nova senha",
                    style: TextStyle(fontWeight: FontWeight.bold),
                  ),

                  const SizedBox(height: 20),

                  TextField(
                    controller: senhaController,
                    obscureText: true,
                    decoration: const InputDecoration(
                      labelText: "Nova senha",
                      border: OutlineInputBorder(),
                    ),
                  ),

                  const SizedBox(height: 20),

                  TextField(
                    controller: confirmarController,
                    obscureText: true,
                    decoration: const InputDecoration(
                      labelText: "Confirmar senha",
                      border: OutlineInputBorder(),
                    ),
                  ),

                  const SizedBox(height: 20),

                  ElevatedButton.icon(
                    onPressed: _resetarSenha,
                    icon: const Icon(Icons.lock_reset, color: Colors.white),
                    label: const Text(
                      "Redefinir senha",
                      style: TextStyle(color: Colors.white),
                    ),
                    style: ElevatedButton.styleFrom(
                      minimumSize: const Size(double.infinity, 50),
                      backgroundColor: const Color(0xFF0A66C2),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(30),
                      ),
                    ),
                  ),

                  const SizedBox(height: 15),

                  Text(
                    mensagem,
                    style: const TextStyle(color: Colors.red),
                  ),
                ],
              ),
            ),
          ),
        ),
      ],
    );
  }

  //////////////////////////////////////////////////////
  /// LÓGICA
  //////////////////////////////////////////////////////
  void _resetarSenha() {
    if (senhaController.text.isEmpty ||
        confirmarController.text.isEmpty) {
      setState(() {
        mensagem = "Preencha todos os campos.";
      });
      return;
    }

    if (senhaController.text != confirmarController.text) {
      setState(() {
        mensagem = "As senhas não coincidem.";
      });
      return;
    }

    setState(() {
      mensagem = "Senha redefinida com sucesso!";
    });

    Future.delayed(const Duration(seconds: 2), () {
      Navigator.pushReplacement(
  context,
  MaterialPageRoute(
    builder: (context) => LoginPage(
      onLogin: () {},
      onVoltar: () {},
    ),
  ),
);
    });
  }
}