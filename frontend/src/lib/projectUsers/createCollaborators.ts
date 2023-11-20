export async function createCollaborator(id_user: string, id_project: string,is_editor: boolean) {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/createcollaborator/${id_user}/${id_project}/${is_editor}`);
  const data = await response.json();
  console.log(data)
  return data;
}