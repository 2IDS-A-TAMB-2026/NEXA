import 'package:flutter/material.dart';
import '../controllers/auth_controller.dart';
import '../models/user_model.dart';

class RegisterPage extends StatefulWidget {
  const RegisterPage({super.key});

  @override
  State<RegisterPage> createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage> {
  final nome = TextEditingController();
  final cpf = TextEditingController();
  final email = TextEditingController();
  final telefone = TextEditingController();
  final senha = TextEditingController();
  final tipo = TextEditingController();
  final dataNascimento= TextEditingController();
  final  tipoPerfil = TextEditingController();
  final  uidRfid = TextEditingController();
  final  epis = TextEditingController();

  void register() {
    AuthController.register(
      UserModel(
        nome: nome.text,
        cpf: cpf.text,
        email: email.text,
        telefone: telefone.text,
        senha: senha.text,
        tipo: tipo.text,
        dataNascimento: dataNascimento.text,
        tipoPerfil: tipoPerfil.text,
        uidRfid: uidRfid.text,
        epis: epis.text,
      ),
    );

    Navigator.pop(context);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFF5F6FA),
      appBar: AppBar(),
      body: Padding(
        padding: const EdgeInsets.all(20),
        child: ListView(
          children: [
            const SizedBox(height: 10),

            const Text(
              "Cadastro",
              style: TextStyle(
                fontSize: 26,
                fontWeight: FontWeight.bold,
                color: Color(0xFF1F3C5B),
              ),
            ),

            const SizedBox(height: 30),

            campo("Nome", Icons.person),
            campo("CPF", Icons.badge),
            campo("Email", Icons.email),
            campo("Telefone", Icons.phone),
            campo("Senha", Icons.lock, isPassword: true),

            const SizedBox(height: 30),

            ElevatedButton.icon(
              onPressed: () {},
                icon: const Icon(Icons.person_add),
                label: const Text("Cadastrar"),
                style: ElevatedButton.styleFrom(
                  backgroundColor: const Color(0xFF1F66B1),
                  foregroundColor: Colors.white, 
                  padding: const EdgeInsets.symmetric(vertical: 15),
                  shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(30),
                ),
              ),
            )
          ],
        ),
      ),
    );
  }

  Widget campo(String label, IconData icon, {bool isPassword = false}) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 20),
      child: TextField(
        obscureText: isPassword,
        decoration: InputDecoration(
          labelText: label,
          prefixIcon: Icon(icon, color: Color(0xFF1F66B1)),
          filled: true,
          fillColor: Colors.white,

          contentPadding: const EdgeInsets.symmetric(
            horizontal: 15,
            vertical: 18,
          ),

          border: OutlineInputBorder(borderRadius: BorderRadius.circular(10)),

          enabledBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(10),
            borderSide: const BorderSide(color: Colors.grey),
          ),

          focusedBorder: OutlineInputBorder(
            borderRadius: BorderRadius.circular(10),
            borderSide: const BorderSide(color: Color(0xFF1F66B1), width: 2),
          ),
        ),
      ),
    );
  }
}

