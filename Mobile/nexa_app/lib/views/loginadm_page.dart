import 'package:flutter/material.dart';
import 'package:nexa_app/views/recuperar_senha_page.dart';

class LoginadmPage extends StatefulWidget {
  final VoidCallback onLogin;
  final VoidCallback onVoltar;

  const LoginadmPage({
    super.key,
    required this.onLogin,
    required this.onVoltar,
  });

  @override
  State<LoginadmPage> createState() => _LoginadmPageState();
}

class _LoginadmPageState extends State<LoginadmPage> {
  final emailController = TextEditingController();
  final senhaController = TextEditingController();

  String? erroEmail;
  String? erroSenha;

  void validar() {
    setState(() {
      erroEmail = null;
      erroSenha = null;

      if (emailController.text.isEmpty ||
          !emailController.text.contains("@")) {
        erroEmail = "E-mail inválido";
      }

      if (senhaController.text.isEmpty ||
          senhaController.text.length < 6) {
        erroSenha = "Mínimo 6 caracteres";
      }

      if (erroEmail == null && erroSenha == null) {
        widget.onLogin();
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    final largura = MediaQuery.of(context).size.width;
    final isMobile = largura < 800;
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Scaffold(
      backgroundColor:
          isDark ? const Color(0xFF0D1117) : const Color(0xFFF4F6FA),
      body: isMobile
          ? _mobileLayout(context, isDark)
          : _desktopLayout(context, isDark),
    );
  }

  Widget _mobileLayout(BuildContext context, bool isDark) {
    return SingleChildScrollView(
      child: Column(
        children: [
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
                  "Login Administrador",
                  style: TextStyle(
                      fontSize: 26,
                      fontWeight: FontWeight.bold,
                      color: Colors.white),
                ),
              ],
            ),
          ),

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
                  Align(
                    alignment: Alignment.centerLeft,
                    child: TextButton.icon(
                      onPressed: widget.onVoltar,
                      icon: const Icon(Icons.undo, color: Color(0xFF0A66C2)),
                      label: const Text("Voltar",
                      style: TextStyle(color:Color.fromARGB(255, 47, 41, 119))),
                    ),
                  ),

                  campo("E-mail", Icons.email, isDark,
                      controller: emailController, erro: erroEmail),

                  campo("Senha", Icons.lock, isDark,
                      controller: senhaController,
                      isPassword: true,
                      erro: erroSenha),

                  const SizedBox(height: 20),

                  ElevatedButton.icon(
                    onPressed: validar,
                    icon: const Icon(Icons.login, color: Colors.white),
                    label: const Text("Entrar como administrador",
                        style: TextStyle(color: Colors.white)),
                    style: ElevatedButton.styleFrom(
                      minimumSize: const Size(double.infinity, 50),
                      backgroundColor: const Color(0xFF0A66C2),
                    ),
                  ),

                  const SizedBox(height: 10),

                  TextButton(
                    onPressed: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (_) => const RecuperarSenhaPage(),
                        ),
                      );
                    },
                    child: const Text("Esqueci a senha",
                    style: TextStyle(color: Color.fromARGB(255, 10, 25, 153))),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

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
                  Align(
                    alignment: Alignment.centerLeft,
                    child: TextButton.icon(
                      onPressed: widget.onVoltar,
                      icon: const Icon(Icons.undo, color: Color(0xFF0A66C2)),
                      label: const Text("Voltar"),
                    ),
                  ),

                  Image.asset("assets/logo_branco.png", height: 60),

                  const SizedBox(height: 10),

                  const Text(
                    "Login Administrador",
                    style: TextStyle(
                        fontSize: 24,
                        fontWeight: FontWeight.bold),
                  ),

                  const SizedBox(height: 20),

                  campo("E-mail", Icons.email, isDark,
                      controller: emailController, erro: erroEmail),

                  campo("Senha", Icons.lock, isDark,
                      controller: senhaController,
                      isPassword: true,
                      erro: erroSenha),

                  const SizedBox(height: 20),

                  ElevatedButton.icon(
                    onPressed: validar,
                    icon: const Icon(Icons.login, color: Colors.white),
                    label: const Text("Entrar como administrador"),
                    style: ElevatedButton.styleFrom(
                      minimumSize: const Size(double.infinity, 50),
                      backgroundColor: const Color(0xFF0A66C2),
                    ),
                  ),

                  const SizedBox(height: 10),

                  TextButton(
                    onPressed: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (_) => const RecuperarSenhaPage(),
                        ),
                      );
                    },
                    child: const Text("Esqueci a senha"),
                  ),
                ],
              ),
            ),
          ),
        ),
      ],
    );
  }

  Widget campo(
    String label,
    IconData icon,
    bool isDark, {
    bool isPassword = false,
    required TextEditingController controller,
    String? erro,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 15),
      child: TextField(
        controller: controller,
        obscureText: isPassword,
        decoration: InputDecoration(
          labelText: label,
          errorText: erro,
          prefixIcon: Icon(icon),
          border: OutlineInputBorder(
            borderRadius: BorderRadius.circular(12),
          ),
        ),
      ),
    );
  }
}