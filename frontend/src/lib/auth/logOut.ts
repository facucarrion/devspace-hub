export function logOut() {
  localStorage.removeItem('jwt')
  localStorage.removeItem('user_id')
}