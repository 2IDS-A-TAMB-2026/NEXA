import 'package:flutter/material.dart';
import 'package:nexa_app/models/user_model.dart';
import 'package:nexa_app/views/redefinir_senha.dart';


class RecuperarSenhaPage extends StatefulWidget {
  const RecuperarSenhaPage({super.key});

  @override
  State<RecuperarSenhaPage> createState() => _RecuperarSenhaPageState();
}

class _RecuperarSenhaPageState extends State<RecuperarSenhaPage> {
  final emailController = TextEditingController();
  String mensagem = "";

  void validarEmail() {
    if (emailController.text.trim().toLowerCase() ==
        usuarioLogado.email.trim().toLowerCase()) {
      setState(() {
        mensagem = "E-mail válido! Redirecionando...";
      });

      Future.delayed(const Duration(seconds: 1), () {
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => const NovaSenhaPage(),
          ),
        );
      });
    } else {
      setState(() {
        mensagem = "E-mail não encontrado.";
      });
    }
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

  //////////////////////////////////////////////////////
  /// MOBILE
  //////////////////////////////////////////////////////
  Widget _mobileLayout(BuildContext context, bool isDark) {
    return SingleChildScrollView(
      child: Column(
        children: [
          _topo(),
          Transform.translate(
            offset: const Offset(0, -30),
            child: _form(isDark),
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
            child: SizedBox(width: 420, child: _form(isDark)),
          ),
        ),
      ],
    );
  }

  //////////////////////////////////////////////////////
  /// COMPONENTES
  //////////////////////////////////////////////////////
  Widget _topo() {
    return Container(
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
            "Recuperar Senha",
            style: TextStyle(
                fontSize: 26,
                fontWeight: FontWeight.bold,
                color: Colors.white),
          ),
        ],
      ),
    );
  }

  Widget _form(bool isDark) {
    return Container(
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
        mainAxisSize: MainAxisSize.min,
        children: [
          const Text(
            "Informe o e-mail cadastrado",
            style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
          ),
          const SizedBox(height: 20),

          TextField(
            controller: emailController,
            decoration: const InputDecoration(
              labelText: "E-mail",
              border: OutlineInputBorder(),
            ),
          ),

          const SizedBox(height: 20),

          ElevatedButton.icon(
            onPressed: validarEmail,
            icon: const Icon(Icons.send, color: Colors.white),
            label: const Text("Enviar",
                style: TextStyle(color: Colors.white)),
            style: ElevatedButton.styleFrom(
              minimumSize: const Size(double.infinity, 50),
              backgroundColor: const Color(0xFF0A66C2),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(30),
              ),
            ),
          ),

          const SizedBox(height: 15),

          Text(mensagem, style: const TextStyle(color: Colors.red)),
        ],
      ),
    );
  }
}