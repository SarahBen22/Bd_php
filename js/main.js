const modal = document.querySelector('.modal')
const cover = document.querySelector('.cover')

const seeMore = ref => {
  if (modal.style.visibility === 'hidden') {
    modal.style.visibility = ''
  }
  modal.innerHTML = "<div class='loading'></div>"
  modal.classList.toggle('show')
  cover.classList.toggle('show')

  fetch(`detail.php?ref=${ref}`)
    .then(res => res.text())
    .then(data => {
      modal.innerHTML = data
    })
    .catch(err => console.log(err))
}

const removeModal = () => {
  modal.classList.toggle('show')
  cover.classList.toggle('show')
}
