import 'package:flutter/material.dart';
import 'package:flutter_tts/flutter_tts.dart';

class AccessibilityController extends ChangeNotifier {
  bool altoContraste = false;
  double escalaFonte = 1.0;

  final FlutterTts tts = FlutterTts();

  AccessibilityController() {
    _initTTS();
  }

void _initTTS() async {
  await tts.setLanguage("pt-BR");
  await tts.setSpeechRate(0.5);
  await tts.setPitch(1.0);
  await tts.setVolume(1.0);
}

  

  void aumentarFonte() {
    escalaFonte += 0.1;
    notifyListeners();
  }

  void diminuirFonte() {
    if (escalaFonte > 0.8) {
      escalaFonte -= 0.1;
      notifyListeners();
    }
  }

 Future<void> lerTexto(String texto) async {
  if (texto.trim().isEmpty) return;

  await tts.stop();
  await tts.speak(texto);
}
}