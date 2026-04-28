import 'package:flutter/material.dart';

class DashboardPageFun extends StatelessWidget {
  const DashboardPageFun({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Bem-vindo ao NEXA")),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: const [
            Text(
              "Olá, fulano",
              style: TextStyle(
                fontSize: 22,
                fontWeight: FontWeight.bold,
              ),
            ),
            SizedBox(height: 10),
            Text(
              "A Nexa é uma plataforma criada para facilitar sua experiência, oferecendo soluções práticas, seguras e acessíveis. Nosso principal objetivo é conectar você a serviços de forma rápida, garantindo organização, eficiência e confiança em cada interação dentro do aplicativo. \n Valorizamos a transparência e o respeito. Por isso, você tem o direito de acessar suas informações, solicitar correções, garantir a privacidade dos seus dados e utilizar a plataforma com segurança. Seus dados são protegidos e utilizados apenas para melhorar sua experiência, sempre seguindo boas práticas de segurança e privacidade. \n Além disso, buscamos constantemente evoluir, ouvindo nossos usuários e aprimorando nossos serviços. Você também tem o direito de receber suporte, esclarecer dúvidas e utilizar todas as funcionalidades de forma clara e sem complicações. \n A Nexa existe para você — com foco em inovação, confiança e respeito.",
              style: TextStyle(fontSize: 12),
            ),
          ],
        ),
      ),
    );
  }
}