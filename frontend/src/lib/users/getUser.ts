export async function getUser(id: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/users/${+id}`)
  const data = await response.json()
  return data
}

export async function getUserByUsername(username: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/users/username/${username}`)
  const data = await response.json()
  return data
}