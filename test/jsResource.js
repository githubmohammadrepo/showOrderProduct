let names = { name: ' soma' }

function changeName(name) {
    name.name = 'hi ' + name.name;
}

name = 'soma';

console.log(name)
changeName(names)

console.log(names.name)