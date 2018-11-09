app.controller('myCtrl', function($scope, $http) {
    $scope.mostrarFormDispo         = false;
    $scope.mostrarFormReserva       = false;
    $scope.mostrarMisReservas       = false;
    $scope.errorMisReservas         = false;
    $scope.masCamposMisReservas     = false;
    $scope.camposMisReservas        = false;
    $scope.textMasCamposMisReservas = '+';
    $scope.mensajeReservaCreada     = '';
    $scope.resultDisponibilidad     = [];
    $scope.resultMisReservas        = [];
    $scope.formDisponibilidad       = [];
    $scope.formDatosReserva         = [];
    $scope.formMisReservas          = [];
    $scope.datosDispo               = [];
    $scope.datosReserva             = [];
    $scope.preciosHabitaciones      = [];
    $scope.misReservasDatos         = [];
    $scope.textoBotonInfo           = [];

    var initFormDisponibilidad      = function () {
        $scope.formDisponibilidad = {
            llegada         : null,
            salida          : null
        };

        $scope.datosDispo   = {
            errorDatos      : null,
            mensajeAlert    : '',
            llegada         : null,
            salida          : null
        };
    };

    var initFormDatosReserva        = function () {
        $scope.formDatosReserva  = {
            llegada         : null,
            salida          : null,
            tipoHabitacion  : null,
            tipoPension     : null,
            precio          : null,
            nombre          : null,
            apellidos       : null,
            telefono        : null,
            email           : null,
            numAdultos      : 2,
            numNinos        : 0,
            numBebes        : 0
        };

        $scope.datosReserva   = {
            errorDatos      : null,
            mensajeAlert    : '',
            tipoHabitacion  : null,
            tipoPension     : null,
            precio          : null,
            nombre          : null,
            apellidos       : null,
            telefono        : null,
            email           : null,
            numAdultos      : null,
            numNinos        : null,
            numBebes        : null
        };
    };

    var initFormMisReservas         = function () {
        $scope.formMisReservas  = {
            voucher     : null,
            apellido    : null,
            idreserva   : null,
            nombre      : null,
            email       : null
        };
    };

    $scope.findPrecios              = function () {
        $http.get(apiPrefix + 'precios')
            .success(function (data) {
                $scope.preciosHabitaciones  = angular.copy(data);
            })
            .error(function (data) {
                $scope.datosReserva.precio          = true;
                $scope.datosReserva.mensajeAlert    = 'No se han podido cargar los precios.';
            });
    };

    $scope.VerDisponibilidad        = function () {
        $scope.datosDispo   = {
            errorDatos      : ($scope.formDisponibilidad.llegada == null || $scope.formDisponibilidad.salida == null)?true:false,
            mensajeAlert    : ($scope.formDisponibilidad.llegada == null || $scope.formDisponibilidad.salida == null)?'Datos incorrectos':'',
            llegada         : ($scope.formDisponibilidad.llegada == null || $scope.formDisponibilidad.llegada == '')?true:false,
            salida          : ($scope.formDisponibilidad.salida == null || $scope.formDisponibilidad.salida == '')?true:false
        };

        if ($scope.datosDispo.errorDatos == false) {
            $http.post(apiPrefix + 'disponibilidad', {'datos': $scope.formDisponibilidad})
                .success(function (data) {
                    if (!data.error) {
                        $scope.mostrarFormDispo = true;
                        $scope.formDatosReserva.llegada = $scope.formDisponibilidad.llegada;
                        $scope.formDatosReserva.salida  = $scope.formDisponibilidad.salida;
                        $scope.findPrecios();
                    } else {
                        $scope.datosDispo.errorDatos    = true;
                        $scope.datosDispo.llegada       = true;
                        $scope.datosDispo.salida        = true;
                        $scope.datosDispo.mensajeAlert  = data.message;
                    }
                })
                .error(function (data) {
                    console.log(data);
                    $scope.datosDispo.errorDatos    = true;
                    $scope.datosDispo.mensajeAlert  = data.message;
                });
        }
    };

    $scope.CargarPrecioHab          = function () {
        angular.forEach($scope.preciosHabitaciones, function (value) {
            if (value.tipoHabitacion == $scope.formDatosReserva.tipoHabitacion) {
                var milisegundosxdia    = 1000 * 60 * 60 * 24;
                var numdias             = $scope.formDisponibilidad.salida - $scope.formDisponibilidad.llegada;
                numdias                 = numdias / milisegundosxdia;
                $scope.formDatosReserva.precio  = angular.copy(value.precioxdia);
                $scope.formDatosReserva.precio  = $scope.formDatosReserva.precio * numdias;
            }
        });
    };

    $scope.ContinnuarDatosReserva   = function () {
        $scope.datosReserva   = {
            errorDatos      : ($scope.formDatosReserva.tipoHabitacion == null || $scope.formDatosReserva.tipoPension == null)?true:false,
            mensajeAlert    : 'Compruebe los datos seleccionados',
            tipoHabitacion  : ($scope.formDatosReserva.tipoHabitacion == null)?true:false,
            tipoPension     : ($scope.formDatosReserva.tipoPension == null)?true:false,
            precio          : ($scope.formDatosReserva.precio == null)?true:false
        };

        if ($scope.datosReserva.errorDatos != true) {
            $scope.mostrarFormDispo                 = false;
            $scope.mostrarFormReserva               = true;
        }
    };

    $scope.ConfirmarReserva         = function () {
        $scope.datosReserva   = {
            errorDatos      : ($scope.formDatosReserva.nombre == null || $scope.formDatosReserva.apellidos == null || $scope.formDatosReserva.numAdultos == null || ($scope.formDatosReserva.telefono == null && $scope.formDatosReserva.email == null))?true:false,
            mensajeAlert    : 'Compruebe los datos. Algunos datos son incorrectos',
            nombre          : ($scope.formDatosReserva.nombre == null)?true:false,
            apellidos       : ($scope.formDatosReserva.apellidos == null)?true:false,
            telefono        : ($scope.formDatosReserva.telefono == null && $scope.formDatosReserva.email == null)?true:false,
            email           : ($scope.formDatosReserva.telefono == null && $scope.formDatosReserva.email == null)?true:false,
            numAdultos      : ($scope.formDatosReserva.numAdultos == null)?true:false
        };

        if ($scope.datosReserva.errorDatos == false) {
            $http.post(apiPrefix + 'createreserva', {'datos': $scope.formDatosReserva})
                .success(function (data) {
                    console.log(data);
                    $scope.formMisReservas.idreserva    = data.datos.reserva;
                    $scope.formMisReservas.voucher      = null;
                    $scope.formMisReservas.apellido     = null;
                    $scope.mensajeReservaCreada         = 'Reserva Creada con Éxito !!!';
                    $scope.BuscarMisReservas(data.datos.misreservas);
                })
                .error(function (data) {
                    console.log('error');
                    console.log(data);
                    $scope.mensajeReservaCreada     = '';
                    $scope.errorMisReservas         = true;
                    $scope.textoErrorMisReservas    = 'Ha habido un erro al crear la reserva. Por favor, inténtelo de nuevo.';
                });
        }

    };

    $scope.VolverADisponibilidad    = function () {
        $scope.mostrarFormDispo     = false;
    };

    $scope.VolverFormDisponibilidad = function () {
        $scope.mostrarFormDispo     = true;
        $scope.mostrarFormReserva   = false;
    };

    $scope.BuscarMisReservas        = function (misreservas) {
        var verificarcampos = true;

        if ($scope.formMisReservas.idreserva != null) {
            verificarcampos = true;
        } else if ($scope.formMisReservas.voucher != null && $scope.formMisReservas.apellido != null) {
            verificarcampos             = true;
            $scope.mensajeReservaCreada = '';
        } else if ($scope.formMisReservas.nombre != null && $scope.formMisReservas.apellido != null &&$scope.formMisReservas.email != null) {
            verificarcampos             = true;
            $scope.mensajeReservaCreada = '';
        } else {
            verificarcampos             = false;
            $scope.mensajeReservaCreada = '';
        }

        if (verificarcampos == true) {
            $http.post(apiPrefix + 'misreservas', {'datos': $scope.formMisReservas})
                .success(function (data) {
                    console.log(data);
                    $scope.resultMisReservas    = angular.copy(data);
                    angular.forEach($scope.resultMisReservas, function (value) {
                        $scope.misReservasDatos[value.id]   = false;
                        $scope.textoBotonInfo[value.id]     = '+';
                    });
                    $scope.mostrarMisReservas   = true;
                    $scope.mostrarFormDispo     = false;
                    $scope.mostrarFormReserva   = false;
                    $scope.camposMisReservas    = false;
                    if (misreservas != null ) {
                        angular.forEach(misreservas, function (reserva) {
                            $scope.resultMisReservas.push(reserva);
                            angular.forEach(reserva, function (value) {
                                $scope.misReservasDatos[value.id]   = false;
                                $scope.textoBotonInfo[value.id]     = '+';
                            });
                        });
                    }
                    initFormDatosReserva();
                    initFormDisponibilidad();
                })
                .error(function (data) {
                    console.log('error');
                    console.log(data);
                    $scope.errorMisReservas         = true;
                    $scope.textoErrorMisReservas    = 'Ha habido un error en la búsqueda de las reservas. Por favor, compruebe los datos';
                });
        } else {
            $scope.camposMisReservas = true;
        }

    };

    $scope.MostrarInfoReserva       = function (idReserva) {
        if ($scope.misReservasDatos[idReserva] == true) {
            $scope.misReservasDatos[idReserva] = false;
            $scope.textoBotonInfo[idReserva]   = '+';
        } else {
            $scope.misReservasDatos[idReserva] = true;
            $scope.textoBotonInfo[idReserva]   = '-';
        }

    };

    $scope.MostrarMasCampos         = function () {
        if ($scope.masCamposMisReservas == true) {
            $scope.masCamposMisReservas = false;
            $scope.textMasCamposMisReservas = '+';
        } else {
            $scope.masCamposMisReservas = true;
            $scope.textMasCamposMisReservas = '-';
        }
    };

    $scope.LimpiarMisReservas       = function () {
        $scope.mostrarMisReservas   = false;
        $scope.camposMisReservas    = false;
        initFormMisReservas();
    };

    $scope.CambioFechaLlegada       = function () {
        $scope.formDisponibilidad.salida    = angular.copy($scope.formDisponibilidad.llegada);
    };

    initFormDatosReserva();
    initFormDisponibilidad();
    initFormMisReservas();

});