from flask import Flask, request, jsonify, send_from_directory
from ollama import chat
from pydantic import BaseModel
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

class Country(BaseModel):
    livro: str
    autor: str
    prefacio: list[str]

@app.route('/ask', methods=['POST'])
def ask_country():
    data = request.get_json()

    if not data or 'message' not in data:
        return jsonify({'error': 'Missing "message" field'}), 400

    user_message = data['message']

    # Chamar o modelo
    response = chat(
        messages=[{'role': 'user', 'content': user_message}],
        model='gemma3',
        format=Country.model_json_schema(),
    )

    # Validar e converter para objeto Country
    country = Country.model_validate_json(response.message.content)

    # Retornar como JSON
    return jsonify(country.dict())

@app.route('/')
def index():
    return send_from_directory(app.static_folder, 'ollama.html')

if __name__ == '__main__':
    app.run(debug=True)



# curl -X POST http://localhost:5000/ask \
#      -H "Content-Type: application/json" \
#      -d '{"message": "Tell me about Canada."}'