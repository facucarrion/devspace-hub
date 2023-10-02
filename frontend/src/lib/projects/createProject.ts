interface Props {
  title: string
  description: string
  id_user_creator: number
}

export async function createProject({ title, description, id_user_creator }: Props) {
  const response = await fetch('http://127.0.0.1:8080/api/projects', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      title,
      description,
      id_user_creator
    })
  })

  const data = await response.json()

  return data
}