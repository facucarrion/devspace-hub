<script>
  const handleClick = (event) => {
    if (localStorage.getItem('user_id')) return

    event.preventDefault()

    if(confirm('Quieres loggearte para hacer esto?')) {
      location.href = 'http://localhost:3000/auth'
    } 
  }
</script>

<a
  class='px-2 py-1 font-bold text-white bg-green-500 rounded-sm'
  href='http://localhost:3000/projects/new'
  on:click={handleClick}
>
  + New Project
</a>