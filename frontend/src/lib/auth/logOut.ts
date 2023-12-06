export function logOut() {
  localStorage.removeItem('jwt')
  localStorage.removeItem('user_id')
  localStorage.removeItem('jwt_secret')
  location.reload()
}