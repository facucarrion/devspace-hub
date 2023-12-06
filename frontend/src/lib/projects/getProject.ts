export async function getProject(id: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/${id}`)
  const data = await response.json()
  return data
}

export async function getProjectsByCreator(id_user: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/creator/${id_user}`)
  const data = await response.json()
  return data
}

export async function getProjectsByCollaborator(id_user: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/collab/${id_user}`)
  const data = await response.json()
  return data
}

export async function upvotes(id: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/upvotes/${id}`)
  const data = await response.json()
  return data
}