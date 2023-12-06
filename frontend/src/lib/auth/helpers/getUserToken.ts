export async function getUserToken() {
  const tokenKey = await fetch(`http://127.0.0.1:8080/api/auth/get-secret/${localStorage.getItem('user_id') ?? '0'}`)
    .then(res => res.json())
    .then(data => data.token)
    .catch(err => console.error(err))

  return tokenKey
}