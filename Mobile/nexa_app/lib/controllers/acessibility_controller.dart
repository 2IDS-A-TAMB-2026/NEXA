import 'package:flutter/material.dart';
import 'package:flutter_tts/flutter_tts.dart';

class AccessibilityController extends ChangeNotifier {
  final FlutterTts _leitor = FlutterTts();

  bool _darkMode = false;
  double _fontSizeScale = 1.0;

  bool get darkMode => _darkMode;
  double get fontSizeScale => _fontSizeScale;

  void toggleDarkMode() {
    _darkMode = !_darkMode;
    notifyListeners();
  }

  void definirModoEscuro(bool ativar) {
    if (_darkMode == ativar) return;
    _darkMode = ativar;
    notifyListeners();
  }

  void aumentarFonte() {
    // Limite máximo reduzido para 1.15 para proteger o layout mobile
    if (_fontSizeScale >= 1.15) return;
    // Incremento ajustado para 0.05 para um aumento super suave
    _fontSizeScale = (_fontSizeScale + 0.05).clamp(0.8, 1.15).toDouble();
    notifyListeners();
  }

  void diminuirFonte() {
    if (_fontSizeScale <= 0.8) return;
    // Decremento ajustado para 0.05 para manter a simetria
    _fontSizeScale = (_fontSizeScale - 0.05).clamp(0.8, 1.15).toDouble();
    notifyListeners();
  }

  Future<void> lerTexto(String texto) async {
    if (texto.trim().isEmpty) return;
    await _leitor.stop();
    await _leitor.setLanguage('pt-BR');
    await _leitor.setSpeechRate(0.45);
    await _leitor.speak(texto);
  }

  Future<void> pararLeitura() async {
    await _leitor.stop();
  }

  @override
  void dispose() {
    _leitor.stop();
    super.dispose();
  }
}
