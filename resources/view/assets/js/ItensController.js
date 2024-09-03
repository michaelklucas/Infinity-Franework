
document.querySelector('#modalPerigo button[type="submit"]').addEventListener('click', function() {
    const input = document.querySelector('#modalPerigo input[name="perigo"]');
    const value = input.value;
    const select = document.querySelector('#inputGroupSelect01');
    const option = document.createElement('option');
    option.value = value + '-mnl';
    option.text = value + '-mnl';
    select.add(option);
    select.selectedIndex = select.options.length - 1;

});

document.querySelector('#modalConsequencias button[type="submit"]').addEventListener('click', function() {
    const input = document.querySelector('#modalConsequencias input[name="consequencia"]');
    const value = input.value;
    const select = document.querySelector('#inputGroupSelect02');
    const option = document.createElement('option');
    option.value = value + '-mnl';
    option.text = value + '-mnl';
    select.add(option);
    select.selectedIndex = select.options.length - 1;
});

// Crie o elemento pai com um nome fixo
const parentDiv = document.createElement('div');
//parentDiv.classList.add('itens-pai');
document.querySelector('#PaiItens').appendChild(parentDiv);

// Adicione novos elementos ao elemento pai
const modalItens = document.querySelectorAll('#modalScrollable .modal-body li');
modalItens.forEach(function(item) {
    item.addEventListener('click', function() {
        const value = item.textContent;

        // Crie o novo elemento div
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('itens-controle');

        // Crie o novo elemento input
        const itemInput = document.createElement('input');
        //itemInput.type = 'hidden';
        itemInput.classList.add('form-control', 'michael');
        itemInput.value = value;
        itemInput.name = 'itens_controle[]';

        // Adicione o novo elemento input ao novo elemento div
        itemDiv.appendChild(itemInput);

        // Adicione o novo elemento div ao elemento pai
        parentDiv.appendChild(itemDiv);

        // Adicione um evento de clique para remover o novo elemento div
        itemDiv.addEventListener('click', function() {
            itemDiv.parentNode.removeChild(itemDiv);
        });
    });
});

// Crie o elemento pai com um nome fixo
const parentInput = document.createElement('input');
parentInput.type = 'hidden';
//parentInput.name = 'itens_pai';
document.querySelector('#PaiItens').appendChild(parentInput);

// Adicione novos elementos ao elemento pai
document.querySelector('#modalScrollable button[type="submit"]').addEventListener('click', function() {
    const input = document.querySelector('#modalScrollable input[name="ItensDiv"]');
    const value = input.value;

    // Crie o novo elemento div
    const itemDiv = document.createElement('div');
    itemDiv.classList.add('itens-controle');

    // Crie o novo elemento input
    const itemInput = document.createElement('input');
    //itemInput.type = 'hidden';
    itemInput.classList.add('form-control', 'michael');
    itemInput.value = value + '-mnl';
    itemInput.name = 'itens_controle[]';

    // Adicione o novo elemento input ao novo elemento div
    itemDiv.appendChild(itemInput);

    // Adicione o novo elemento div ao elemento pai
    parentDiv.appendChild(itemDiv);

    // Adicione um evento de clique para removê-lo
    itemInput.addEventListener('click', function() {
        itemInput.parentNode.removeChild(itemInput);
    });
});


var filtro = document.getElementById("filtroInput");
var itens = document.getElementsByClassName("filtro");

// Adicione um ouvinte de eventos ao campo de filtro
filtro.addEventListener("keyup", function () {
    // Obtenha o valor do filtro
    var valorFiltro = filtro.value.toLowerCase();

    // Percorra todos os itens na lista e filtre aqueles que atendem ao critério
    Array.prototype.filter.call(itens, function (items) {
        var conteudoItem = items.textContent.toLowerCase();
        if (conteudoItem.indexOf(valorFiltro) === -1) {
            items.style.display = "none";
        } else {
            items.style.display = "block";
        }
    });
});
