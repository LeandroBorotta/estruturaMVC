<?php

namespace App\Services;

class PaginateService {

    protected $resultado_por_pagina;
    protected $pagina_atual;
    protected $inicio_do_resultado;
    protected $total_de_resultados;
    protected $total_de_paginas;

    public function __construct($resultado_por_pagina, $pagina_atual) {
        $this->resultado_por_pagina = $resultado_por_pagina;
        $this->pagina_atual = $pagina_atual;
        $this->inicio_do_resultado = ($this->pagina_atual - 1) * $this->resultado_por_pagina;
    }

    public function setTotalResultados($total_de_resultados) {
        $this->total_de_resultados = $total_de_resultados;
        $this->total_de_paginas = ceil($this->total_de_resultados / $this->resultado_por_pagina);
    }

    public function getInicioResultado() {
        return $this->inicio_do_resultado;
    }

    public function getResultadosPorPagina() {
        return $this->resultado_por_pagina;
    }

    public function getTotalPaginas() {
        return $this->total_de_paginas;
    }

    public function criarLinksPaginacao($url) {
        $links = "";
        for ($i = 1; $i <= $this->total_de_paginas; $i++) {
            $links .= "<a href='{$url}?pagina={$i}'>{$i}</a> ";
        }
        return $links;
    }
}
?>
