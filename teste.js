// let array = new Array();
// array.push(10)
// console.log(array.length);

// var array2 = new Object();
// array2['chave'] = 'valor';
// console.log(array2);

// for(chave in array2){
//     console.log(array2[chave]);
// }

// array3 = {
//     'nome':'Matheus',
//     teste(){ console.log(this.nome);},
//     'number': 10
// }

// array3.teste();
// console.log(array3.number);


// pessoas = {
//     'pessoa1':{
//         nome:'juliana',
//         idade: 15
//     },
//     'pessoa2':{
//         'nome':'marcos',
//         'idade': 17
//     }
// }

// for (pessoa in pessoas){
//    console.log(pessoa.nome);
// }

// let a = 1;
// let a2 = 1;
// let a3 = a2;
// console.log(a3 == a2);

// b1 = new Object();
// b2 = new Object();
// console.log(b1 == b2);

// var d = 11
// switch(d){
//    case 1:
//     console.log('maior que 1');
//    case 11:
//     console.log('igaul');
// }

// function nome(){
//     console.log('ola');
// }
// nome();


// function porcentagem(a, porcet='%'){
//     console.log(`${a+porcet}`);
// }

// function palidromo(p1){
//     let p2 ='';
//     for(let i = p1.length-1; i>=0;i--){
//          p2 += p1[i];
//     }
//     return p1 == p2 ? console.log('É igual') : console.log('Não é igual');
// }

// function convert(numero){
//     let resto = '';
//     while(true){
//         resto += numero % 2;
//         numero = parseInt(numero / 2);
//         if(numero == 0){
//             break;
//         }
//     }
//     let valor_binario = '';
//     for(let i=resto.length-1; i>=0; i--){
//         valor_binario += resto[i];
//     }
//     return valor_binario
// }

// console.log(convert(33));

function fatorial(numero){
    let fatorial = 1;
    for(let i = numero; i >0; i--){
        fatorial *= i;
    }
    return fatorial;
}

console.log(fatorial(6));