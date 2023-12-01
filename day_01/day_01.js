let fs = require('fs')

fs.readFile('./day_01/day_01_test.txt', 'utf-8', (err, data) => {
  if (err) {
    console.error(err)
    return
  }

  main(data)
})

function reverse(string) {
  let reversedString = ''
  for (let index = string.length - 1; index > -1; index--) {
    const element = string[index]
    reversedString += element
  }
  return reversedString
}

function is_numeric(string) {
  let number = parseInt(string)
  return !isNaN(number)
}

function get_first_number(string, reversed = false) {
  if (reversed) {
    string = reverse(string)
  }
  for (let index = 0; index < string.length; index++) {
    const char = string[index]
    if (is_numeric(char)) {
      return char
    }
  }
  return ''
}

function get_number(line) {
  number = get_first_number(line) + get_first_number(line, true)
  return parseInt(number)
}

function sum(numbers) {
  return numbers.reduce((value, acc) => acc + value, 0)
}

function main(data) {
  let solution = []
  data = data.split('\n')
  data.forEach((line) => {
    let value = get_number(line)
    solution.push(value)
  })

  console.log(sum(solution))
}
