import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:mask_text_input_formatter/mask_text_input_formatter.dart';


/// 🔥 APP COM TEMA
class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,

     
    );
  }
}

/// ================= PAGE =================
class RegisterPage extends StatefulWidget {
  const RegisterPage({super.key});

  @override
  State<RegisterPage> createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage> {

  final nomeController = TextEditingController();
  final cpfController = TextEditingController();
  final dataController = TextEditingController();
  final emailController = TextEditingController();
  final telefoneController = TextEditingController();
  final senhaController = TextEditingController();
  final confirmarSenhaController = TextEditingController();

  final cnpjController = TextEditingController();
  final rfidController = TextEditingController();
  final setorController = TextEditingController();

  String mensagem = "";

  /// 🔥 MÁSCARAS
  final cpfMask = MaskTextInputFormatter(
    mask: '###.###.###-##',
    filter: {"#": RegExp(r'[0-9]')},
  );

  final telefoneMask = MaskTextInputFormatter(
    mask: '(##) #####-####',
    filter: {"#": RegExp(r'[0-9]')},
  );

  final cnpjMask = MaskTextInputFormatter(
    mask: '##.###.###/####-##',
    filter: {"#": RegExp(r'[0-9]')},
  );

  void cadastrar() {
    if (nomeController.text.isEmpty ||
        cpfController.text.isEmpty ||
        emailController.text.isEmpty ||
        telefoneController.text.isEmpty ||
        senhaController.text.isEmpty ||
        confirmarSenhaController.text.isEmpty ||
        cnpjController.text.isEmpty ||
        rfidController.text.isEmpty ||
        setorController.text.isEmpty) {
      setState(() {
        mensagem = "Preencha todos os campos";
      });
      return;
    }

    if (senhaController.text != confirmarSenhaController.text) {
      setState(() {
        mensagem = "As senhas não coincidem";
      });
      return;
    }

    setState(() {
      mensagem = "";
    });

    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(
        content: Text("Usuário cadastrado com sucesso!"),
        backgroundColor: Colors.green,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;

    return Scaffold(
        backgroundColor: Colors.transparent,
      body: 
      SafeArea(
  child: Padding(
    padding: const EdgeInsets.all(10),

    child: ClipRRect(
      borderRadius: BorderRadius.circular(25), // 🔥 AQUI ARREDONDA TUDO

      child: Container(
         color: const Color(0xFFE9EDF3), // fundo real da tela

          /// 🔥 CONTEÚDO
         
            child: ListView(
              padding: const EdgeInsets.all(20),

              children: [

                const SizedBox(height: 10),

                /// 🔷 TÍTULO
                Text(
                  "Cadastro de Funcionário",
                  textAlign: TextAlign.center,
                  style: TextStyle(
                    fontSize: 26,
                    fontWeight: FontWeight.bold,
                    color: Colors.blue,
                  ),
                ),

                const SizedBox(height: 25),

                tituloSecao("Informações pessoais", isDark),

                campo("E-mail corporativo", emailController, Icons.email, isDark),

                linhaCampos(
                  campo("Nome completo", nomeController, Icons.person, isDark),
                  campo(
                    "CPF",
                    cpfController,
                    Icons.badge,
                    isDark,
                    keyboardType: TextInputType.number,
                    inputFormatters: [cpfMask],
                  ),
                ),

                linhaCampos(
                  campo("Data de nascimento", dataController, Icons.calendar_today, isDark),
                  campo(
                    "Telefone",
                    telefoneController,
                    Icons.phone,
                    isDark,
                    keyboardType: TextInputType.phone,
                    inputFormatters: [telefoneMask],
                  ),
                ),

                const SizedBox(height: 20),

                tituloSecao("Empresa", isDark),

                linhaCampos(
                  campo(
                    "CNPJ",
                    cnpjController,
                    Icons.business,
                    isDark,
                    keyboardType: TextInputType.number,
                    inputFormatters: [cnpjMask],
                  ),
                  campo("ID do Setor", setorController, Icons.badge, isDark),
                ),

                campo("UID RFID", rfidController, Icons.nfc, isDark),

                const SizedBox(height: 20),

                tituloSecao("Segurança", isDark),

                linhaCampos(
                  campo("Senha", senhaController, Icons.lock, isDark, isPassword: true),
                  campo("Confirmar senha", confirmarSenhaController, Icons.lock, isDark, isPassword: true),
                ),

                if (mensagem.isNotEmpty)
                  Padding(
                    padding: const EdgeInsets.only(top: 10),
                    child: Text(
                      mensagem,
                      style: const TextStyle(color: Colors.red),
                    ),
                  ),

                const SizedBox(height: 25),

                /// 🔥 BOTÃO
                ElevatedButton(
                  onPressed: cadastrar,
                  child: const Text("Cadastrar"),
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color(0xFF0A66C2),
                    foregroundColor: Colors.white,
                    minimumSize: const Size(double.infinity, 55),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(20),
                    ),
                  ),
                ),

                const SizedBox(height: 40),
              ],
            ),
          ),
    ),
  ),
      ),
        
      );
  }

  /// 🔵 TÍTULO SEÇÃO
  Widget tituloSecao(String text, bool isDark) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: Text(
        text,
        style: TextStyle(
          fontSize: 18,
          fontWeight: FontWeight.bold,
          color: isDark ? Colors.white : const Color(0xFF0A66C2),
        ),
      ),
    );
  }

  /// CAMPOS LADO A LADO
  Widget linhaCampos(Widget c1, Widget c2) {
    return Row(
      children: [
        Expanded(child: c1),
        const SizedBox(width: 10),
        Expanded(child: c2),
      ],
    );
  }

  /// 🔥 CAMPO COM GLASS EFFECT
  Widget campo(
    String label,
    TextEditingController controller,
    IconData icon,
    bool isDark, {
    bool isPassword = false,
    List<TextInputFormatter>? inputFormatters,
    TextInputType? keyboardType,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 12),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(18),

        child: BackdropFilter(
          filter: ImageFilter.blur(sigmaX: 10, sigmaY: 10),

          child: TextField(
            controller: controller,
            obscureText: isPassword,
            keyboardType: keyboardType,
            inputFormatters: inputFormatters,

            style: TextStyle(color: isDark ? Colors.white : Colors.black),

            decoration: InputDecoration(
              prefixIcon: Icon(icon, color: const Color(0xFF0A66C2)),
              labelText: label,

              labelStyle: TextStyle(
                color: isDark ? Colors.white70 : Colors.black54,
              ),

              filled: true,
              fillColor: isDark
                  ? Colors.white.withOpacity(0.05)
                  : Colors.white.withOpacity(0.6),

              border: OutlineInputBorder(
                borderRadius: BorderRadius.circular(18),
                borderSide: BorderSide.none,
              ),
            ),
          ),
        ),
      ),
    );
  }
}