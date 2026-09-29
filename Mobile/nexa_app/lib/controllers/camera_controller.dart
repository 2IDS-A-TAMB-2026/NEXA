import 'package:camera/camera.dart';
import 'package:flutter/material.dart';
import 'package:permission_handler/permission_handler.dart';

class CameraControllerApp extends ChangeNotifier {
  CameraController? controller;

  bool inicializando = true;
  String? erro;

  Future<void> inicializar() async {
    try {
      // 1. SOLICITA PERMISSÃO AO SISTEMA OPERATIVO
      var status = await Permission.camera.status;
      if (!status.isGranted) {
        status = await Permission.camera.request();
      }

      if (!status.isGranted) {
        erro = 'Permissão de acesso à câmara foi negada.';
        inicializando = false;
        notifyListeners();
        return;
      }

      // 2. BUSCA AS CÂMERAS DISPONÍVEIS
      final cameras = await availableCameras();

      if (cameras.isEmpty) {
        erro = 'Nenhuma câmera encontrada.';
        inicializando = false;
        notifyListeners();
        return;
      }

      final camera = cameras.firstWhere(
        (camera) => camera.lensDirection == CameraLensDirection.front,
        orElse: () => cameras.first,
      );

      controller = CameraController(
        camera,
        ResolutionPreset.medium,
        enableAudio: false,
      );

      await controller!.initialize();

      inicializando = false;
      notifyListeners();
    } catch (e) {
      erro = 'Erro ao iniciar câmera: $e';
      inicializando = false;
      notifyListeners();
    }
  }

  Future<XFile?> tirarFoto() async {
    if (controller == null || !controller!.value.isInitialized) {
      return null;
    }

    if (controller!.value.isTakingPicture) {
      return null;
    }

    try {
      return await controller!.takePicture();
    } catch (e) {
      erro = 'Erro ao tirar foto: $e';
      notifyListeners();
      return null;
    }
  }

  @override
  void dispose() {
    controller?.dispose();
    super.dispose();
  }
}
