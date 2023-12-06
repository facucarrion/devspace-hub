export async function searchProjects(name: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/projects/search?q=${name}`);
  const data = await response.json();
  return data;
}