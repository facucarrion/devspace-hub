export async function insert(idProject: number, idUser: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/tag-projects/insert`);
  const data = await response.json();

  return data;
}