/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     7/12/2016 8:51:16 a. m.                      */
/*==============================================================*/


drop table if exists ACUERDOADMINISTRAT;

drop table if exists ASIGNACIONACADEMIC;

drop table if exists ASISTENCIA;

drop table if exists CICLO;

drop table if exists DEPARTAMENTO;

drop table if exists DETALLEASISTENCIA;

drop table if exists EMPLEADO;

drop table if exists EXPEDIENTEACADEMIC;

drop table if exists EXPEDIENTEADMINIST;

drop table if exists EXPERIENCIALABORAL;

drop table if exists PERFILPUESTO;

drop table if exists PERMISO;

drop table if exists PUESTO;

drop table if exists TIEMPOADICIONAL;

/*==============================================================*/
/* Table: ACUERDOADMINISTRAT                                    */
/*==============================================================*/
create table ACUERDOADMINISTRAT
(
   IDACUERDO            varchar(11) not null,
<<<<<<< HEAD
   IDEXPEDIENTE         varchar(20) not null,
=======
   IDEMPLEADO           int not null,
>>>>>>> origin/fabi
   MOTIVOACUERDO        varchar(50) not null,
   DESCRIPCIONACUERDO   varchar(250) not null,
   ESTADOACUERDO        varchar(10) not null,
   FECHAACUERDO         varchar(14) not null,
   ARCHIVOACUERDO       varchar(250) not null,
   primary key (IDACUERDO)
);

/*==============================================================*/
/* Table: ASIGNACIONACADEMIC                                    */
/*==============================================================*/
create table ASIGNACIONACADEMIC
(
   IDASIGNACIONACAD     int not null auto_increment,
   IDEXPEDIENTEACADEM   varchar(20) not null,
   IDCICLO              int not null,
   ANO                  varchar(10) not null,
   CODASIGNATURA        varchar(6),
   NOMBREASIGNATURA     varchar(50),
   GTEORICO             varchar(30),
   GDISCUSION           varchar(30),
   GLABORATORIO         varchar(30),
   TIEMPOTOTAL          int not null,
   RESPONSABILIDADADMIN varchar(1000),
   primary key (IDASIGNACIONACAD)
);

/*==============================================================*/
/* Table: ASISTENCIA                                            */
/*==============================================================*/
create table ASISTENCIA
(
   IDASISTENCIA         int not null auto_increment,
   FECHAASISTENCIA      char(10) not null,
   TURNO                int not null,
   primary key (IDASISTENCIA)
);

/*==============================================================*/
/* Table: CICLO                                                 */
/*==============================================================*/
create table CICLO
(
   IDCICLO              int not null auto_increment,
   NOMBRECICLO          char(10) not null,
   primary key (IDCICLO)
);

/*==============================================================*/
/* Table: DEPARTAMENTO                                          */
/*==============================================================*/
create table DEPARTAMENTO
(
   IDDEPARTAMENTO       int not null auto_increment,
   NOMBREDEPARTAMENTO   varchar(50) not null,
   DESCRIPCIONDEPARTA   varchar(250) not null,
   primary key (IDDEPARTAMENTO)
);

/*==============================================================*/
/* Table: DETALLEASISTENCIA                                     */
/*==============================================================*/
create table DETALLEASISTENCIA
(
   IDDETALLEASISTENCIA  int not null auto_increment,
   IDEXPEDIENTE         varchar(20) not null,
   IDASISTENCIA         int not null,
   HORAENTRADA          char(8) not null,
   HORASALIDA           char(8) not null,
   OBSERVACIONES        varchar(250),
   primary key (IDDETALLEASISTENCIA)
);

/*==============================================================*/
/* Table: EMPLEADO                                              */
/*==============================================================*/
create table EMPLEADO
(
   IDEMPLEADO           int not null auto_increment,
   FOTO                 varchar(250),
   PRIMERNOMBRE         varchar(30) not null,
   SEGUNDONOMBRE        varchar(30),
   PRIMERAPELLIDO       varchar(30) not null,
   SEGUNDOAPELLIDO      varchar(30) not null,
   DUI                  varchar(10) not null,
   NIT                  varchar(20) not null,
   ISSS                 varchar(10) not null,
   AFP                  varchar(12) not null,
   ESTADO               int not null,
   SEXO                 varchar(1) not null,
   primary key (IDEMPLEADO)
);

/*==============================================================*/
/* Table: EXPEDIENTEACADEMIC                                    */
/*==============================================================*/
create table EXPEDIENTEACADEMIC
(
   IDEXPEDIENTEACADEM   varchar(20) not null,
   IDEMPLEADO           int not null,
   FECHAAPERTURAEXPACAD varchar(12) not null,
   NOMBREINSTITUCION    varchar(50),
   ANOTITULACION        varchar(12),
   TITULOOBTENIDO       varchar(50),
   TITULOESTUDIO        varchar(50),
   DIRECCIONINSTITUCION varchar(50),
   DESCRIPCIONACADEMICA varchar(250),
   POSTGRADOS           varchar(2000),
   primary key (IDEXPEDIENTEACADEM)
);

/*==============================================================*/
/* Table: EXPEDIENTEADMINIST                                    */
/*==============================================================*/
create table EXPEDIENTEADMINIST
(
   IDEXPEDIENTE         varchar(20) not null,
   IDEMPLEADO           int not null,
   IDPUESTO             int not null,
   FECHAAPERTURA        varchar(20) not null,
   CODIGOCONTRATO       varchar(20) not null,
   TIEMPOINTEGRAL       bool not null,
   DESCRIPCIONADMIN     varchar(250),
   MODALIDADCONTRATACION varchar(60) not null,
   primary key (IDEXPEDIENTE)
);

/*==============================================================*/
/* Table: EXPERIENCIALABORAL                                    */
/*==============================================================*/
create table EXPERIENCIALABORAL
(
   IDEXPLABACADEMICA    int not null auto_increment,
   IDEXPEDIENTEACADEM   varchar(20) not null,
   DESCRIPCIONEXPLAB    varchar(250) not null,
   NOMBREINSTITUCIONEXPLABACAD varchar(50) not null,
   FECHAINICIOEXPLABACAD varchar(12) not null,
   FECHAFINALIZACIONEXPLABACAD varchar(12) not null,
   primary key (IDEXPLABACADEMICA)
);

/*==============================================================*/
/* Table: PERFILPUESTO                                          */
/*==============================================================*/
create table PERFILPUESTO
(
   IDPERFILPUESTO       int not null auto_increment,
   PROFESION            varchar(250) not null,
   REPORTA              varchar(100) not null,
   SUSTITUTO            varchar(150) not null,
   RELACIONES           varchar(150) not null,
   RESPONSABILIDADES    longtext not null,
   SUSTITUYE            varchar(50) not null,
   primary key (IDPERFILPUESTO)
);

/*==============================================================*/
/* Table: PERMISO                                               */
/*==============================================================*/
create table PERMISO
(
   IDPERMISO            int not null auto_increment,
   IDEXPEDIENTE         varchar(20) not null,
   FECHAPERMISO         char(10) not null,
   FECHASOLICITUD       char(10) not null,
   MOTIVOPERMISO        varchar(250) not null,
   ESTADOPERMISO        int not null,
   TIEMPOSOLICITADOHORA int not null,
   TIEMPOSOLICITADOMIN  int not null,
   GOCESUELDO           int not null,
   primary key (IDPERMISO)
);

/*==============================================================*/
/* Table: PUESTO                                                */
/*==============================================================*/
create table PUESTO
(
   IDPUESTO             int not null auto_increment,
   IDDEPARTAMENTO       int not null,
   IDPERFILPUESTO       int not null,
   NOMBREPUESTO         varchar(50) not null,
   DESCRIPCIONPUESTO    varchar(250) not null,
   SALARIOPUESTO        float not null,
   primary key (IDPUESTO)
);

/*==============================================================*/
/* Table: TIEMPOADICIONAL                                       */
/*==============================================================*/
create table TIEMPOADICIONAL
(
   IDTIEMPO             int not null auto_increment,
   IDEXPEDIENTE         varchar(20) not null,
   IDCICLO              int not null,
   FECHAINICIO          varchar(12) not null,
   FECHAFIN             varchar(12) not null,
   DESCRIPCION          varchar(250),
   ANO                  varchar(4) not null,
   primary key (IDTIEMPO)
);

alter table ACUERDOADMINISTRAT add constraint FK_FK_EMPLEADO_ACUERDADMIN foreign key (IDEMPLEADO)
      references EMPLEADO (IDEMPLEADO) on delete restrict on update restrict;

alter table ASIGNACIONACADEMIC add constraint FK_FK_CICLO_ASIGNACIONACAD foreign key (IDCICLO)
      references CICLO (IDCICLO) on delete restrict on update restrict;

alter table ASIGNACIONACADEMIC add constraint FK_FK_EXPEDIENTEACAD_ASIGNACAD foreign key (IDEXPEDIENTEACADEM)
      references EXPEDIENTEACADEMIC (IDEXPEDIENTEACADEM) on delete restrict on update restrict;

alter table DETALLEASISTENCIA add constraint FK_FK_ASISTENCIA_DETALLEASISTENCIA foreign key (IDASISTENCIA)
      references ASISTENCIA (IDASISTENCIA) on delete restrict on update restrict;

alter table DETALLEASISTENCIA add constraint FK_FK_EXPEDIENTEADMIN_ASISTENCIA foreign key (IDEXPEDIENTE)
      references EXPEDIENTEADMINIST (IDEXPEDIENTE) on delete restrict on update restrict;

alter table EXPEDIENTEACADEMIC add constraint FK_FK_EMPLEADO_EXPEDIENTEACAD foreign key (IDEMPLEADO)
      references EMPLEADO (IDEMPLEADO) on delete restrict on update restrict;

alter table EXPEDIENTEADMINIST add constraint FK_FK_EMPLEADO_EXPEDIENTEADMIN foreign key (IDEMPLEADO)
      references EMPLEADO (IDEMPLEADO) on delete restrict on update restrict;

alter table EXPEDIENTEADMINIST add constraint FK_FK_PUESTO_EXPEDIENTEADMIN foreign key (IDPUESTO)
      references PUESTO (IDPUESTO) on delete restrict on update restrict;

alter table EXPERIENCIALABORAL add constraint FK_FK_EXPEDIENTEACAD_EPXLABACAD foreign key (IDEXPEDIENTEACADEM)
      references EXPEDIENTEACADEMIC (IDEXPEDIENTEACADEM) on delete restrict on update restrict;

alter table PERMISO add constraint FK_FK_EXPEDIENTEADMIN_PERMISO foreign key (IDEXPEDIENTE)
      references EXPEDIENTEADMINIST (IDEXPEDIENTE) on delete restrict on update restrict;

alter table PUESTO add constraint FK_FK_DEPARTAMENTO_PUESTO foreign key (IDDEPARTAMENTO)
      references DEPARTAMENTO (IDDEPARTAMENTO) on delete restrict on update restrict;

alter table PUESTO add constraint FK_FK_PERFILPUESTO_PUESTO foreign key (IDPERFILPUESTO)
      references PERFILPUESTO (IDPERFILPUESTO) on delete restrict on update restrict;

alter table TIEMPOADICIONAL add constraint FK_FK_CICLO_TIEMPOADICIONAL foreign key (IDCICLO)
      references CICLO (IDCICLO) on delete restrict on update restrict;

alter table TIEMPOADICIONAL add constraint FK_FK_EXPEDIENTEADMIN_TIEMPOADICIONAL foreign key (IDEXPEDIENTE)
      references EXPEDIENTEADMINIST (IDEXPEDIENTE) on delete restrict on update restrict;

