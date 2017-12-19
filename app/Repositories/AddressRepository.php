<?php
namespace App\Repositories;
use AnthonyMartin\GeoLocation\GeoLocation;
use App\Address;
use Illuminate\Support\Facades\DB;

class AddressRepository
{
    /**
     * Faz a busca por endereço utilizando latitude e longitude em
     * um raio a partir das coordenadas informadas.
     *
     * @param string|int $latitude Cordenada latitude do endereço
     * @param string|int $longitude Cordenada longitude do endereço
     * @param int $limit_km Raio de busca de restaurantes
     *
     * @return array
     */
    public function getByLatLong($latitude, $longitude, $limit_km)
    {
        $restaurants = Address::select(\DB::raw("id, latitude, longitude, restaurant_id, ( 6371 * acos( cos( radians({$latitude}) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians({$longitude}) ) + sin( radians({$latitude}) ) * sin( radians( latitude ) ) ) ) AS distance"))
            ->orderBy('distance')
            ->having('distance', '<=', $limit_km)
            ->having('restaurant_id', '>', 0)
            ->limit(20)
            ->with(['restaurant'])
            ->get();
        return compact('restaurants', 'latitude', 'longitude');
    }
    /**
     * Faz a busca por cidade, você pode incluir um rank de "qualidade" ou
     * quantidade de acesso, por exemplo.
     *
     * @param string $city Cidade de interesse
     *
     * @return array
     */
    public function getByCity($city)
    {
        $restaurants = Address::select()
            ->where('city', $city)
            ->having('restaurant_id', '>', 0)
            ->limit(20)
            ->with(['restaurant'])
            ->get();
        return compact('restaurants');
    }
    /**
     * Retorna o resultado por cidade ou coordenadas, a preferência é
     * por cidade, para uma busca mais efetiva
     *
     * @param string $location O endereço a pesquisar
     *
     * @return array
     */
    public function getByAddress($location)
    {
        $response = GeoLocation::getGeocodeFromGoogle($location);
        /**
         * Este bloco é a novidade, aqui em um método getCitites()
         * que vai retornar um array de cidades que atendemos.
         * Se o endereço for o nome de alguma cidade, partimos para
         * a busca no método getByCity(), veja getCitites() a baixo
         */
        if (in_array($location, $this->getCities())) {
            $data = $this->getByCity($location);
            $status = ['success'];
            return array_merge($data, $status);
        }
        if (!empty($response->results) and is_array($response->results)) {
            $result = array_pop($response->results);
            $latitude = $result->geometry->location->lat;
            $longitude = $result->geometry->location->lng;
            $limit_km = 10;
            $data = $this->getByLatLong($latitude, $longitude, $limit_km);
            $status = ['success'];
            return array_merge($data, $status);
        }
    }
    /**
     * Retorna as cidades atendidas pelo aplicativo você pode implementar
     * QUALQUER lógica para retornar cidades que você atende, inclusive
     * bancos de dados, neste caso, vou retornar apenas um array mesmo
     *
     * @return array
     */
    protected function getCities()
    {
        $results = DB::select("SELECT city FROM addresses");
        return $results;

    }
}