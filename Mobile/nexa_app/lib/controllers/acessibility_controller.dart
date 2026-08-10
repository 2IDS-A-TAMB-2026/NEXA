import 'package:flutter/material.dart';

class AccessibilityController extends ChangeNotifier {
  // 1. Variável privada para salvar o estado (começa como 'false' - modo claro)
  bool _darkMode = false;

  // 2. Getter público: ele retorna o valor de _darkMode (nunca retornará nulo)
  bool get darkMode => _darkMode;

  // 3. Método para mudar de claro para escuro e vice-versa
  void toggleDarkMode() {
    _darkMode = !_darkMode;
    notifyListeners(); // Isso avisa a tela para atualizar as cores automaticamente
  }

  // --- SEUS OUTROS MÉTODOS (FONTE, ÁUDIO, ETC.) ---
  double _fontSizeScale = 1.0;
  double get fontSizeScale => _fontSizeScale;

  void aumentarFonte() {
    _fontSizeScale += 0.1;
    notifyListeners();
  }

  void diminuirFonte() {
    _fontSizeScale -= 0.1;
    notifyListeners();
  }

  void lerTexto(String texto) {
    // Sua lógica de áudio aqui
  }
}