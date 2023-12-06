export const newProjectLink = async (link: string, id_project: string) => {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/links`, {
    method: 'POST',
    body: JSON.stringify({ link, id_project }),
  })
  const data = await response.json()
  console.log(data)
  return data
}