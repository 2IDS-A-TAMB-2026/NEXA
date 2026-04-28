import 'package:flutter/material.dart';
import 'package:nexa_app/views/dashboard_page.dart';
import '../views/login_page.dart';
import '../views/register_page.dart';
import '../views/profile_page.dart';
import '../views/epis_page.dart';
import '../views/cameras_page.dart';

class AppRoutes {
  static final Map<String, WidgetBuilder> routes = {
    '/': (_) => const LoginPage(),
    '/register': (_) => const RegisterPage(),
    '/dashboard': (_) => const Dashboard(),
    '/profile': (_) => const PerfilPage(),
    '/epis': (_) => const EpisPage(),
    '/cameras': (_) => const CamerasPage(),
  };
}