var MatrizDeRisco = {
    calculaRisco: function calcularRisco(severidade, probabilidade) {
        if (severidade === 1) {
            if (probabilidade === 1 || probabilidade === 2) {
                return 'Desprezível';
            }
            if (probabilidade === 3) {
                return 'Baixo';
            }
            if (probabilidade === 4) {
                return 'Moderado';
            }

        }

        if (severidade === 2) {
            if (probabilidade === 1) {
                return 'Desprezível';
            }
            if (probabilidade === 2) {
                return 'Baixo';
            }
            if (probabilidade === 3) {
                return 'Moderado';
            }
            if (probabilidade === 4) {
                return 'Sério';
            }
        }

        if (severidade === 3) {
            if (probabilidade === 1) {
                return 'Baixo';
            }
            if (probabilidade === 2) {
                return 'Moderado';
            }
            if (probabilidade === 3) {
                return 'Sério';
            }
            if (probabilidade === 4) {
                return 'Crítico';
            }
        }

        if (severidade === 4) {
            if (probabilidade === 1) {
                return 'Moderado';
            }
            if (probabilidade === 2) {
                return 'Sério';
            }
            if (probabilidade === 3 || probabilidade === 4) {
                return 'Crítico';
            }

        }

        return 'Baixo';
    }

};

// View de matriz de risco
var MatrizDeRiscoView = {
    init: function() {
        // Seleciona os elementos HTML
        this.severidadeSlider = document.getElementById('severidade-slider');
        this.probabilidadeSlider = document.getElementById('probabilidade-slider');
        this.matrizDeRisco = document.getElementById('matriz-de-risco');
        // Configura os sliders de severidade e probabilidade
        noUiSlider.create(this.severidadeSlider, {
            behaviour: "tap-drag",
            start: 1,
            step: 1,
            connect: !0,
            direction: isRtl ? "rtl" : "ltr",
            range: {
                'min': 1,
                'max': 4
            },

            pips: {
                mode: 'steps',
                stepped: !0,
                density: 80,
                values: [1, 2, 3, 4],
                format: {
                    to: function(value) {
                        return ['Desprezível', 'Baixo', 'Moderado', 'Serio'][value-1];
                    }
                }
            }
        });
        noUiSlider.create(this.probabilidadeSlider, {
            behaviour: "tap-drag",
            start: 1,
            step: 1,
            connect: !0,
            direction: isRtl ? "rtl" : "ltr",
            range: {
                'min': 1,
                'max': 4
            },
            pips: {
                mode: 'steps',
                stepped: !0,
                density: 80,
                values: [1, 2, 3, 4],
                format: {
                    to: function(value) {
                        return ['Improvável', 'Remota', 'Provável', 'Frequente'][value-1];
                    }
                }
            }
        });
        // Configura os eventos de atualização dos sliders
        this.severidadeSlider.noUiSlider.on('update', this.atualizaMatrizDeRisco.bind(this));
        this.probabilidadeSlider.noUiSlider.on('update', this.atualizaMatrizDeRisco.bind(this));
    },
    atualizaMatrizDeRisco: function() {
        // Obtém os valores dos sliders
        var severidade = parseInt(this.severidadeSlider.noUiSlider.get());
        var probabilidade = parseInt(this.probabilidadeSlider.noUiSlider.get());
        // Calcula o risco com base nos valores dos sliders
        var risco = MatrizDeRisco.calculaRisco(severidade, probabilidade);
        // Atualiza o texto da matriz de risco com a cor correspondente
        this.matrizDeRisco.textContent = risco;
        this.matrizDeRisco.classList.remove('risco-desprezivel', 'risco-baixo', 'risco-moderado', 'risco-serio','risco-critico');
        if (risco === 'Desprezível') {
            this.matrizDeRisco.classList.add('risco-desprezivel');
        } else if (risco === 'Baixo') {
            this.matrizDeRisco.classList.add('risco-baixo');
        } else if (risco === 'Moderado') {
            this.matrizDeRisco.classList.add('risco-moderado');
        } else if (risco === 'Sério') {
            this.matrizDeRisco.classList.add('risco-serio');
        } else if (risco === 'Crítico') {
            this.matrizDeRisco.classList.add('risco-critico');
        }

        var matrizDeRisco = document.getElementById('matriz-de-risco').innerHTML;

        // Atribuir o valor a um campo oculto em um formulário
        document.getElementById('matriz-de-risco-input').value = matrizDeRisco;

    }
};


// Inicializa a view de matriz de risco
MatrizDeRiscoView.init();
