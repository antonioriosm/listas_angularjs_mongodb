function UbigeoCtrl ($scope, $http) {

    $http.get('ubigeo.php').success(function(data){
        $scope.dptos = data;
        $scope.dpto = data[0].coddep;

        $scope.cargarProvincias();
    });

    $scope.cargarProvincias = function() {
        var coddep = $scope.dpto;

        $http.post('ubigeo.php', {cd: coddep})
            .success(function(data) {
                $scope.provs = data;
                $scope.prov = data[0].codpro;

                $scope.cargarDistritos();

            });
    };

    $scope.cargarDistritos = function() {
        var codpro = $scope.prov;

        $http.post('ubigeo.php', {cp: codpro})
            .success(function(data) {
                $scope.dists = data;
                $scope.dist = data[0].coddis;
            });
    };

}
