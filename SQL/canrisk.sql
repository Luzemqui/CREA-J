-- ============================================================
--  CANRISK — Base de datos (importar en phpMyAdmin)
--  phpMyAdmin -> Importar -> seleccionar este archivo -> Continuar
-- ============================================================
CREATE DATABASE IF NOT EXISTS `canrisk`
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `canrisk`;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id`             INT(11)      NOT NULL AUTO_INCREMENT,
  `nombre`         VARCHAR(100) NOT NULL,
  `usuario`        VARCHAR(50)  NOT NULL,
  `contrasena`     VARCHAR(255) NOT NULL,  -- hash de password_hash()
  `fecha_registro` DATETIME     DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_usuarios_usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
