export async function getByUsername(username: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/users/links/${username}`)
  const data = await response.json()
  return data
}