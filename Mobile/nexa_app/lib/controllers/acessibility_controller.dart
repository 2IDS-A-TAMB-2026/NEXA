import 'package:flutter/material.dart';

class AccessibilityController extends ChangeNotifier {
  // ============================================================
  // MODO ESCURO / MODO CLARO
  // ============================================================

  bool _darkMode = false;

  bool get darkMode => _darkMode;

  void toggleDarkMode() {
    _darkMode = !_darkMode;
    notifyListeners();
  }

  // ============================================================
  // TAMANHO DA FONTE
  // ============================================================

  double _fontSizeScale = 1.0;

  double get fontSizeScale => _fontSizeScale;

  void aumentarFonte() {
    // Evita aumentar infinitamente
    if (_fontSizeScale < 2.0) {
      _fontSizeScale += 0.1;

      if (_fontSizeScale > 2.0) {
        _fontSizeScale = 2.0;
      }

      notifyListeners();
    }
  }

  void diminuirFonte() {
    // Evita diminuir demais
    if (_fontSizeScale > 0.7) {
      _fontSizeScale -= 0.1;

      if (_fontSizeScale < 0.7) {
        _fontSizeScale = 0.7;
      }

      notifyListeners();
    }
  }

  // ============================================================
  // LEITURA DE TEXTO
  // ============================================================

  void lerTexto(String texto) {
    // Sua lógica de áudio aqui
  }

  // ============================================================
  // ALTO CONTRASTE
  // ============================================================

  bool altoContraste = false;

  void toggleHighContrast() {
    altoContraste = !altoContraste;
    notifyListeners();
  }
}