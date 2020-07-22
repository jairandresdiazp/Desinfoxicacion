-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:54780
-- Generation Time: Jul 21, 2020 at 09:20 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desinfoxicacion`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPCommonEmailGet` ()  NO SQL
select * from CommonEmail$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPDocumentoDelete` (IN `pIdDocumento` VARCHAR(30))  NO SQL
DELETE FROM documento WHERE documento.IdDocumento = pIdDocumento$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPDocumentoGet` (IN `pIdUsuario` VARCHAR(30), IN `pNombreDocumento` VARCHAR(100), IN `pPalabrasClave` VARCHAR(200), IN `pAutores` VARCHAR(200), IN `pAnoPublicacion` VARCHAR(10), IN `pIdTipoDocumento` VARCHAR(30))  NO SQL
select documento.IdDocumento,documento.NombreDocumento,documento.Autores,documento.PalabrasClave,documento.URL,documento.Ruta,documento.AnoPublicacion,tipodocumento.Nombre as 'TipoDocumento',tipodocumento.IdTipoDocumento,usuario.UserName,usuario.IdUsuario 
from documento 
INNER JOIN tipodocumento oN documento.IdTipoDocumento=tipodocumento.IdTipoDocumento 
INNER JOIN usuario on documento.IdUsuario=usuario.IdUsuario 
where 
(documento.IdUsuario=pIdUsuario or pIdUsuario='') and
(documento.NombreDocumento=pNombreDocumento or pNombreDocumento='') and 
(documento.PalabrasClave like CONCAT('%',pPalabrasClave,'%') or pPalabrasClave='') and 
(documento.Autores like CONCAT('%',pAutores,'%') or pAutores='') and 
(documento.AnoPublicacion=pAnoPublicacion or pAnoPublicacion='') and 
(tipodocumento.IdTipoDocumento=pIdTipoDocumento or pIdTipoDocumento='')$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPDocumentoNew` (IN `pNombreDocumento` VARCHAR(100), IN `pAutores` VARCHAR(200), IN `pPalabrasClave` VARCHAR(200), IN `pURL` VARCHAR(500), IN `pRuta` VARCHAR(1000), IN `pAnoPublicacion` INT, IN `pIdTipoDocumento` INT, IN `pIdUsuario` INT)  NO SQL
INSERT INTO documento (NombreDocumento, Autores, PalabrasClave, URL, Ruta, AnoPublicacion, IdTipoDocumento, IdUsuario) VALUES (pNombreDocumento, pAutores, pPalabrasClave, pURL, pRuta, pAnoPublicacion, pIdTipoDocumento, pIdUsuario)$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPPerfilGet` ()  NO SQL
select * from perfil$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPTempletNotificacionCodigoGet` (IN `PCodigo` VARCHAR(50))  NO SQL
select * from templatenotificacion where Codigo=PCodigo limit 1$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPTipoDocumentoGet` ()  NO SQL
SELECT * FROM tipodocumento$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPUsuarioGet` (IN `PIdUsuario` VARCHAR(11), IN `PUserName` VARCHAR(1000))  NO SQL
select * from usuario where (UserName=PUserName or PUserName='') and (IdUsuario=PIdUsuario or PIdUsuario='')$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPUsuarioIniciarSesion` (IN `PUserName` VARCHAR(1000), IN `PPass` VARCHAR(1000))  NO SQL
    COMMENT 'Permite a un usuario autenticarse en el sistema'
select * from usuario where UserName=PUserName and Pass=PPass$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPUsuarioLoginUpdate` (IN `pIdUsuario` VARCHAR(100), IN `pPass` VARCHAR(1000))  NO SQL
update usuario set Pass=pPass where IdUsuario=PIdUsuario$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPUsuarioNew` (IN `PNombre` VARCHAR(100), IN `PCorreo` VARCHAR(1000), IN `PFechaNacimiento` VARCHAR(100), IN `PUserName` VARCHAR(1000), IN `PPass` VARCHAR(1000), IN `PCoeficienteDesinfoxicacion` VARCHAR(11), IN `PIdPerfil` VARCHAR(11))  NO SQL
INSERT INTO usuario(Nombre, Correo, FechaNacimiento, UserName, Pass, CoeficienteDesinfoxicacion, IdPerfil) VALUES (PNombre, PCorreo, PFechaNacimiento, PUserName, PPass, PCoeficienteDesinfoxicacion, PIdPerfil)$$

CREATE DEFINER=`azure`@`localhost` PROCEDURE `SPUsuarioUpdate` (IN `PIdUsuario` VARCHAR(10), IN `pNombre` VARCHAR(100), IN `pCorreo` VARCHAR(1000), IN `pFechaNacimiento` VARCHAR(100), IN `pIdPerfil` VARCHAR(10))  NO SQL
update usuario set Nombre=pNombre, Correo=pCorreo, FechaNacimiento=FechaNacimiento, IdPerfil=pIdPerfil where IdUsuario=PIdUsuario$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `auxiliarcalificaciontotal`
--

CREATE TABLE `auxiliarcalificaciontotal` (
  `IdAuxiliarCalificacionTotal` int(11) NOT NULL,
  `CalificacionTotal` decimal(20,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Esta tabla contiene las calificaciones totales d del sistema';

-- --------------------------------------------------------

--
-- Table structure for table `calificaciondocumento`
--

CREATE TABLE `calificaciondocumento` (
  `IdFactorCalificacion` int(11) NOT NULL,
  `IdItemFactor` int(11) NOT NULL,
  `IdDocumento` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `IdAuxiliarCalificacionTotal` int(11) NOT NULL,
  `Valor` decimal(20,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Esta tabla contiene las calificaciones de los documentos';

-- --------------------------------------------------------

--
-- Table structure for table `commonemail`
--

CREATE TABLE `commonemail` (
  `IdCommonEmail` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Pass` varchar(100) NOT NULL,
  `SendTo` varchar(100) NOT NULL,
  `SendToName` varchar(100) NOT NULL,
  `Bcc` varchar(100) NOT NULL,
  `SMTP` varchar(100) NOT NULL,
  `Port` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Alamacena la configuracion para el envio de correos';

--
-- Dumping data for table `commonemail`
--

INSERT INTO `commonemail` (`IdCommonEmail`, `UserName`, `Pass`, `SendTo`, `SendToName`, `Bcc`, `SMTP`, `Port`) VALUES
(1, 'cMflkTmee4KBc4wS74j8muWqE2P7YprU26hbJZW/wOw=', 'Q29/QDaN2p1QK7ZYMFk4V/Adf2i6CTotq7INCZY0AqY=', 'Y43LOfbKRMlkBhrgjSZKojnytQWqCS2tWh/1ScBL/9o=', 'rYiZE2RRClfX/F7/p5bcrx6sNDXKah5nDULBdIbSJOc=', '', 'LfFx5lMJFKuSKRI2uqqsdgiCFkq+ld1Y7AbvXV6J6M0=', 'ar8G9gzdDP62N9dLfDTMjmY+Pvhwi8hGJSpvbDmKW4Q=');

-- --------------------------------------------------------

--
-- Table structure for table `documento`
--

CREATE TABLE `documento` (
  `IdDocumento` int(11) NOT NULL,
  `NombreDocumento` varchar(100) NOT NULL,
  `Autores` varchar(200) NOT NULL,
  `PalabrasClave` varchar(200) NOT NULL,
  `URL` varchar(500) NOT NULL,
  `Ruta` varchar(1000) NOT NULL,
  `AnoPublicacion` int(11) NOT NULL,
  `IdTipoDocumento` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Esta tabla contiene los documentos del sistema';

--
-- Dumping data for table `documento`
--

INSERT INTO `documento` (`IdDocumento`, `NombreDocumento`, `Autores`, `PalabrasClave`, `URL`, `Ruta`, `AnoPublicacion`, `IdTipoDocumento`, `IdUsuario`) VALUES
(18, 'jair', 'jair', 'uno', '', '1KTox/anAk5nF3xeGU0ccHnMYSnPh2oPMUmr7XOC1g0hyq/myCm48AukRk6pFRiytJPWdKYNi08h1H1Wr8AFDULl8hdm36kakh1Cp8b5rALAVdWeMaud1Z2nQHjTvsPDPTLtRSgTLvY8i8KSa2KDYIboFvh/mTD3X/urXOYXl6k=', 2017, 1, 28),
(19, 'jair', 'jair', 'jair', '', '1KTox/anAk5nF3xeGU0ccHnMYSnPh2oPMUmr7XOC1g0hyq/myCm48AukRk6pFRiytJPWdKYNi08h1H1Wr8AFDYhHpg7CN+Pvs8Xs6mZ6kFeohVh4ms6rD/4LOFmuIOSr9gDCSVd9GbCwVU/LMkFMd3qQZaVQ2Xq05xKA316u5ZE=', 2016, 1, 39);

-- --------------------------------------------------------

--
-- Table structure for table `factorcailifacion`
--

CREATE TABLE `factorcailifacion` (
  `IdFactorCalificacion` int(11) NOT NULL,
  `NombreFactor` int(11) NOT NULL,
  `Descripcion` int(11) NOT NULL,
  `Quien` int(11) NOT NULL COMMENT 'dominio: usuario, articulo'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Esta tabla contiene los factores de calificacion del sistema';

-- --------------------------------------------------------

--
-- Table structure for table `itemfactor`
--

CREATE TABLE `itemfactor` (
  `IdItemFactor` int(11) NOT NULL,
  `NombreItem` varchar(100) NOT NULL,
  `Valoracion` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `IdFactorCalificacion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE `perfil` (
  `IdPerfil` int(11) NOT NULL,
  `NombrePerfil` varchar(50) NOT NULL COMMENT 'dominio: profesor, investigador, estudiante'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Esta tabla contiene los perfiles o roles del sistema';

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`IdPerfil`, `NombrePerfil`) VALUES
(1, 'Profesor'),
(2, 'Investrigador'),
(3, 'Estudiante');

-- --------------------------------------------------------

--
-- Table structure for table `templatenotificacion`
--

CREATE TABLE `templatenotificacion` (
  `IdTemplateNotificacion` int(11) NOT NULL,
  `Codigo` varchar(50) NOT NULL,
  `Asunto` varchar(50) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Body` varchar(10000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `templatenotificacion`
--

INSERT INTO `templatenotificacion` (`IdTemplateNotificacion`, `Codigo`, `Asunto`, `Descripcion`, `Body`) VALUES
(1, 'CrearUsuario', 'Creacion Usuario Desinfoxicacion', 'Creacion de usuarios', '<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100;background:#388e3c;font-family:sans-serif\">\n   <tbody>\n      <tr>\n         <td>\n            <table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" height=\"100\" style=\"width:600px\">\n               <tbody>\n                  <tr>\n                     <td align=\"center\">\n                        <table style=\"padding:30px 0px\" width=\"600px\">\n                           <tbody>\n                              <tr>\n                                 <td><p style=\"font-size:20px;font-weight:bold;padding:0px;color:#fff;margin-bottom:0px\">Desinfoxicacion</p></td>\n                              </tr>\n                           </tbody>\n                        </table>\n                        <table style=\"background:#fff;color:#63666a;text-align:left;padding:35px 50px\" width=\"600px\">\n                           <tbody>\n                              <tr>\n                                 <td>\n                                    <p style=\"font-size:20px;font-weight:bold;padding:0px;color:#253137;margin-bottom:0px\">Estimado: {nombre}</p>\n                                 </td>\n                              </tr>\n                              <tr>\n                                 <td>\n                                    <p style=\"font-size:15px;font-weight:bold;padding:0px;color:#253137;margin-bottom:0px\">Se creo su cuenta para Desinfoxicacion.</p>\n                                 </td>\n                              </tr>\n                              <tr>\n                                 <td>\n                                    <table align=\"left\" style=\"padding:10px 0px;color:#616161;font-size:12px;text-align:center;margin:20px 0px\" width=\"600px\">\n                                       <tbody>\n                                          <tr>\n                                             <td style=\"padding:0px;font-size:11px\">Esta recibiendo este mail porque creó una cuenta para Desinfoxicacion - Fundación Universitaria Los Libertadores</td>\n                                          </tr>\n                                          <tr>\n                                             <td style=\"padding:0px;font-size:11px\">Creado y desarrollado por Fundación Universitaria Los Libertadores.</td>\n                                          </tr>\n                                       </tbody>\n                                    </table>\n                                 </td>\n                              </tr>\n                           </tbody>\n                        </table>\n						<table style=\"padding:30px 0px\" width=\"600px\">\n                           <tbody>\n                              <tr>\n                                 <td><p style=\"font-size:20px;font-weight:bold;padding:0px;color:#fff;margin-bottom:0px\"></p></td>\n                              </tr>\n                           </tbody>\n                        </table>\n                     </td>\n                  </tr>\n               </tbody>\n            </table>\n         </td>\n      </tr>\n   </tbody>\n</table>'),
(2, 'RecuperarClave', 'Clave Usuario Desinfoxicacion', 'reestableces clave de usuarios', '<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100;background:#388e3c;font-family:sans-serif\">\n   <tbody>\n      <tr>\n         <td>\n            <table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" height=\"100\" style=\"width:600px\">\n               <tbody>\n                  <tr>\n                     <td align=\"center\">\n                        <table style=\"padding:30px 0px\" width=\"600px\">\n                           <tbody>\n                              <tr>\n                                 <td><p style=\"font-size:20px;font-weight:bold;padding:0px;color:#fff;margin-bottom:0px\">Desinfoxicacion</p></td>\n                              </tr>\n                           </tbody>\n                        </table>\n                        <table style=\"background:#fff;color:#63666a;text-align:left;padding:35px 50px\" width=\"600px\">\n                           <tbody>\n                              <tr>\n                                 <td>\n                                    <p style=\"font-size:20px;font-weight:bold;padding:0px;color:#253137;margin-bottom:0px\">Estimado: {nombre}</p>\n                                 </td>\n                              </tr>\n                              <tr>\n                                 <td>\n                                    <p style=\"font-size:15px;font-weight:bold;padding:0px;color:#253137;margin-bottom:0px\">La clave de su cuenta para Desinfoxicacion. es <span style=\"font-size:15px;font-weight:bold;padding:0px;color:#388e3c;margin-bottom:0px\">{clave}</span></p>\n                                 </td>\n                              </tr>\n                              <tr>\n                                 <td>\n                                    <table align=\"left\" style=\"padding:10px 0px;color:#616161;font-size:12px;text-align:center;margin:20px 0px\" width=\"600px\">\n                                       <tbody>\n                                          <tr>\n                                             <td style=\"padding:0px;font-size:11px\">Esta recibiendo este mail porque creó una cuenta para Desinfoxicacion - Fundación Universitaria Los Libertadores</td>\n                                          </tr>\n                                          <tr>\n                                             <td style=\"padding:0px;font-size:11px\">Creado y desarrollado por Fundación Universitaria Los Libertadores.</td>\n                                          </tr>\n                                       </tbody>\n                                    </table>\n                                 </td>\n                              </tr>\n                           </tbody>\n                        </table>\n						<table style=\"padding:30px 0px\" width=\"600px\">\n                           <tbody>\n                              <tr>\n                                 <td><p style=\"font-size:20px;font-weight:bold;padding:0px;color:#fff;margin-bottom:0px\"></p></td>\n                              </tr>\n                           </tbody>\n                        </table>\n                     </td>\n                  </tr>\n               </tbody>\n            </table>\n         </td>\n      </tr>\n   </tbody>\n</table>');

-- --------------------------------------------------------

--
-- Table structure for table `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `IdTipoDocumento` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Esta tabla contiene los tipos de documento del sistema';

--
-- Dumping data for table `tipodocumento`
--

INSERT INTO `tipodocumento` (`IdTipoDocumento`, `Nombre`) VALUES
(1, 'Articulo'),
(2, 'Escrito'),
(3, 'Noticia'),
(4, 'Pagina Web'),
(5, 'Trabajo Publicado');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Correo` varchar(1000) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `UserName` varchar(1000) NOT NULL,
  `Pass` varchar(1000) NOT NULL,
  `CoeficienteDesinfoxicacion` int(11) NOT NULL DEFAULT '1',
  `IdPerfil` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Esta tabla contiene los usuarios del sistema';

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Nombre`, `Correo`, `FechaNacimiento`, `UserName`, `Pass`, `CoeficienteDesinfoxicacion`, `IdPerfil`) VALUES
(28, 'jair andres diaz puentes', 'Y64whizJnVN/SLliJhh2NDj/wovZB+5cZYL1z7Ff6bM=', '1994-08-19', 'aZ2CoRBkN92GUMZV2gLFAS/fQdd9pIe2v6y2svgu7ok=', 'aZ2CoRBkN92GUMZV2gLFAS/fQdd9pIe2v6y2svgu7ok=', 0, 3),
(39, 'carlos', 'Y64whizJnVN/SLliJhh2NDj/wovZB+5cZYL1z7Ff6bM=', '1994-08-19', 'C/QvPkYtjQkPk5d741IPI6ysfoLbc4OLFJzP77OQVok=', 'aZ2CoRBkN92GUMZV2gLFAS/fQdd9pIe2v6y2svgu7ok=', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarioitemfactor`
--

CREATE TABLE `usuarioitemfactor` (
  `IdFactorCalificacion` int(11) NOT NULL,
  `IdItemFactor` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `Valor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auxiliarcalificaciontotal`
--
ALTER TABLE `auxiliarcalificaciontotal`
  ADD PRIMARY KEY (`IdAuxiliarCalificacionTotal`);

--
-- Indexes for table `calificaciondocumento`
--
ALTER TABLE `calificaciondocumento`
  ADD KEY `IdFactorCalificacion` (`IdFactorCalificacion`),
  ADD KEY `IdItemFactor` (`IdItemFactor`),
  ADD KEY `IdUsuario` (`IdUsuario`),
  ADD KEY `IdDocumento` (`IdDocumento`),
  ADD KEY `IdAuxiliarCalificacionTotal` (`IdAuxiliarCalificacionTotal`);

--
-- Indexes for table `commonemail`
--
ALTER TABLE `commonemail`
  ADD PRIMARY KEY (`IdCommonEmail`);

--
-- Indexes for table `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`IdDocumento`),
  ADD KEY `IdTipoDocumento` (`IdTipoDocumento`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- Indexes for table `factorcailifacion`
--
ALTER TABLE `factorcailifacion`
  ADD PRIMARY KEY (`IdFactorCalificacion`);

--
-- Indexes for table `itemfactor`
--
ALTER TABLE `itemfactor`
  ADD PRIMARY KEY (`IdItemFactor`),
  ADD KEY `IdFactorCalificacion` (`IdFactorCalificacion`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`IdPerfil`);

--
-- Indexes for table `templatenotificacion`
--
ALTER TABLE `templatenotificacion`
  ADD PRIMARY KEY (`IdTemplateNotificacion`);

--
-- Indexes for table `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`IdTipoDocumento`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `IdPerfil` (`IdPerfil`);

--
-- Indexes for table `usuarioitemfactor`
--
ALTER TABLE `usuarioitemfactor`
  ADD KEY `IdUsuario` (`IdUsuario`),
  ADD KEY `IdItemFactor` (`IdItemFactor`),
  ADD KEY `IdFactorCalificacion` (`IdFactorCalificacion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auxiliarcalificaciontotal`
--
ALTER TABLE `auxiliarcalificaciontotal`
  MODIFY `IdAuxiliarCalificacionTotal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `commonemail`
--
ALTER TABLE `commonemail`
  MODIFY `IdCommonEmail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `documento`
--
ALTER TABLE `documento`
  MODIFY `IdDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `factorcailifacion`
--
ALTER TABLE `factorcailifacion`
  MODIFY `IdFactorCalificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `itemfactor`
--
ALTER TABLE `itemfactor`
  MODIFY `IdItemFactor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `IdPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `templatenotificacion`
--
ALTER TABLE `templatenotificacion`
  MODIFY `IdTemplateNotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `IdTipoDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
