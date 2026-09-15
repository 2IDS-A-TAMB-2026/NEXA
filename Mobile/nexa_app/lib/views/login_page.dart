import 'package:flutter/material.dart';
import 'package:nexa_app/services/api_service.dart';
import 'package:nexa_app/models/user_model.dart';


class LoginPage extends StatefulWidget {
  final VoidCallback onLogin;
  final VoidCallback onVoltar;

  const LoginPage({super.key, required this.onLogin, required this.onVoltar});

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  final emailController = TextEditingController();
  final senhaController = TextEditingController();
bool carregandoLogin = false;
  String? erroEmail;
  String? erroSenha;
Future<void> validar() async {
  setState(() {
    erroEmail = null;
    erroSenha = null;
  });

  if (emailController.text.trim().isEmpty ||
      !emailController.text.contains("@")) {
    setState(() {
      erroEmail = "Digite um e-mail válido";
    });
    return;
  }

  if (senhaController.text.isEmpty ||
      senhaController.text.length < 6) {
    setState(() {
      erroSenha = "Mínimo 6 caracteres";
    });
    return;
  }

  setState(() {
    carregandoLogin = true;
  });

  try {
    final UserModel usuario =
        await ApiService.login(
      emailController.text.trim(),
      senhaController.text,
    );

    usuarioLogado = usuario;

    if (!mounted) return;

    setState(() {
      carregandoLogin = false;
    });

    widget.onLogin();
  } catch (e) {
    if (!mounted) return;

    setState(() {
      carregandoLogin = false;
      erroEmail = e
          .toString()
          .replaceFirst('Exception: ', '');
    });
  }
}

  @override
  Widget build(BuildContext context) {
    final largura = MediaQuery.of(context).size.width;
    final isMobile = largura < 800;
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Scaffold(
      backgroundColor: isDark
          ? const Color(0xFF0D1117)
          : const Color(0xFFF4F6FA),
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
            padding: const EdgeInsets.only(top: 60, bottom: 50),
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
                  "Login",
                  style: TextStyle(
                    fontSize: 30,
                    fontWeight: FontWeight.bold,
                    color: Colors.white,
                  ),
                ),
              ],
            ),
          ),

          /// FORM COM MARGEM LATERAL MAIOR
          Transform.translate(
            offset: const Offset(0, -30),
            child: Container(
              margin: const EdgeInsets.symmetric(
                horizontal: 28,
              ), // Margem lateral aumentada para 28
              padding: const EdgeInsets.all(25),
              decoration: BoxDecoration(
                color: isDark ? const Color(0xFF161B22) : Colors.white,
                borderRadius: BorderRadius.circular(20),
                boxShadow: const [
                  BoxShadow(color: Colors.black12, blurRadius: 10),
                ],
              ),
              child: Column(
                children: [
                  /// VOLTAR
                  Padding(
                    padding: const EdgeInsets.only(bottom: 15),
                    child: Align(
                      alignment: Alignment.centerLeft,
                      child: TextButton.icon(
                        onPressed: widget.onVoltar,
                        icon: const Icon(Icons.undo, color: Color(0xFF0A66C2)),
                        label: const Text(
                          "Voltar",
                          style: TextStyle(
                            color: Color.fromARGB(255, 36, 42, 224),
                          ),
                        ),
                      ),
                    ),
                  ),

                  campo(
                    "E-mail",
                    Icons.email,
                    isDark,
                    controller: emailController,
                    erro: erroEmail,
                  ),

                  campo(
                    "Senha",
                    Icons.lock,
                    isDark,
                    controller: senhaController,
                    isPassword: true,
                    erro: erroSenha,
                  ),

                  const SizedBox(height: 20),

                 ElevatedButton.icon(
  onPressed: carregandoLogin ? null : validar,

  icon: carregandoLogin
      ? const SizedBox(
          width: 22,
          height: 22,
          child: CircularProgressIndicator(
            strokeWidth: 2,
            color: Colors.white,
          ),
        )
      : const Icon(
          Icons.login,
          color: Colors.white,
        ),

  label: Text(
    carregandoLogin ? "Entrando..." : "Entrar",
    style: const TextStyle(
      fontSize: 16,
      fontWeight: FontWeight.bold,
      color: Colors.white,
    ),
  ),

  style: ElevatedButton.styleFrom(
    minimumSize: const Size(
      double.infinity,
      50,
    ),
    backgroundColor: const Color(0xFF0A66C2),
    disabledBackgroundColor: const Color(0xFF7AAEDC),
    shape: RoundedRectangleBorder(
      borderRadius: BorderRadius.circular(30),
    ),
  ),
),

                  const SizedBox(height: 10),

          
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
            child: SingleChildScrollView(
              child: Padding(
                padding: const EdgeInsets.all(32.0),
                child: Container(
                  width: 420,
                  padding: const EdgeInsets.all(35),
                  decoration: BoxDecoration(
                    color: isDark ? const Color(0xFF161B22) : Colors.white,
                    borderRadius: BorderRadius.circular(15),
                    boxShadow: const [
                      BoxShadow(color: Colors.black12, blurRadius: 10),
                    ],
                  ),
                  child: Column(
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Align(
                        alignment: Alignment.centerLeft,
                        child: TextButton.icon(
                          onPressed: widget.onVoltar,
                          icon: const Icon(
                            Icons.undo,
                            color: Color(0xFF0A66C2),
                          ),
                          label: const Text("Voltar"),
                        ),
                      ),

                      const SizedBox(height: 10),

                      Image.asset("assets/logo_branco.png", height: 60),

                      const SizedBox(height: 10),

                      Text(
                        "Login",
                        style: TextStyle(
                          fontSize: 26,
                          fontWeight: FontWeight.bold,
                          color: isDark
                              ? Colors.white
                              : const Color(0xFF1F3C5B),
                        ),
                      ),

                      const SizedBox(height: 20),

                      campo(
                        "E-mail",
                        Icons.email,
                        isDark,
                        controller: emailController,
                        erro: erroEmail,
                      ),

                      campo(
                        "Senha",
                        Icons.lock,
                        isDark,
                        controller: senhaController,
                        isPassword: true,
                        erro: erroSenha,
                      ),

                      const SizedBox(height: 20),

                      ElevatedButton.icon(
                        onPressed: validar,
                        icon: const Icon(Icons.login, color: Colors.white),
                        label: const Text(
                          "Entrar",
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

                      const SizedBox(height: 10),

                    ],
                  ),
                ),
              ),
            ),
          ),
        ),
      ],
    );
  }

  //////////////////////////////////////////////////////
  /// CAMPO COM ERRO
  //////////////////////////////////////////////////////
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
        style: TextStyle(color: isDark ? Colors.white : Colors.black),
        decoration: InputDecoration(
          labelText: label,
          errorText: erro,
          prefixIcon: Icon(icon, color: const Color(0xFF1F66B1)),
          filled: true,
          fillColor: isDark ? const Color(0xFF0D1117) : Colors.white,
          border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
        ),
      ),
    );
  }
}
