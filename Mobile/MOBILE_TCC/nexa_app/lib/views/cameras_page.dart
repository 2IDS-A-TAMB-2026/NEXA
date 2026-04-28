import 'package:flutter/material.dart';


class CamerasPage extends StatefulWidget {
  const CamerasPage({super.key});

  @override
  State<CamerasPage> createState() => _CamerasPageState();
}

class _CamerasPageState extends State<CamerasPage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text("Cadastro de Câmeras")),
      body: const Center(child: Text("Lista de câmeras cadastradas.")),
    );
  }
}

  Widget gridCameras() {
    return GridView.count(
      crossAxisCount: 2,
      crossAxisSpacing: 20,
      mainAxisSpacing: 20,
      children: List.generate(4,
          (index) {
        return Container(
          decoration: BoxDecoration(
            color: Colors.black,
            borderRadius:
                BorderRadius.circular(12),
          ),
          child: const Center(
            child: Icon(
                Icons.videocam,
                color: Colors.white38,
                size: 80),
          ),
        );
      }),
    );
  }