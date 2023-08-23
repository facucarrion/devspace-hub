export async function getUser(id: number) {
  const response = await fetch(`http://localhost:8080/api/users/${id}`)
  const data = await response.json()
  return data
}