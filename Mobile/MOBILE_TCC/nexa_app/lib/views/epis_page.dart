import 'package:flutter/material.dart';

class EpisPage extends StatelessWidget {
  const EpisPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Cadastro de EPIs")),
      body: const Center(child: Text("Lista e cadastro de EPIs.")),
    );
  }
}
