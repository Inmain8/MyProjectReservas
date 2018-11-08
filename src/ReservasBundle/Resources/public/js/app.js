var apiPrefix = location.pathname;

var app = angular.module('app', []);

/*Configuración del servicio interpolateProvider para que angular pueda representar las variables con [[ ]]*/
app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[').endSymbol(']]');
});

// app.config([
//     '$routeProvider',
//     function ($routeProvider) {
//         $routeProvider
//             .when('', {
//                 templateUrl: apiPrefix,
//                 controller: 'myCtrl'
//             })
//     }
// ]);
//
// app.run(function ($rootScope, $state, $stateParams) {
//     $rootScope.$state = $state;
//     $rootScope.$stateParams = $stateParams;
//     $rootScope.globalVariable = 'Amadou'; //global variable
// });

