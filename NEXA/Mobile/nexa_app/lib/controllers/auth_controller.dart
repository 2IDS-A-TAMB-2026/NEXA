import '../models/user_model.dart';

class AuthController {
  static List<UserModel> users = [];

  static UserModel? login(String email, String senha) {
    try {
      return users.firstWhere(
        (u) => u.email == email && u.senha == senha,
      );
    } catch (e) {
      return null;
    }
  }

  static void register(UserModel user) {
    users.add(user);
  }
}