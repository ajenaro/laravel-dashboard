<div class="form-group">
    <label for="team_id">Team</label>
    <select name="team_id" id="team_id" class="form-control">
        <option value="">Selecciona un equipo</option>
        @foreach($teams as $team)
            <option value="{{ $team->id }}"{{ old('team_id', $user->team_id) == $team->id ? ' selected' : '' }}>
                {{ $team->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="profession_id">Profesión</label>
    <select name="profession_id" id="profession_id" class="form-control">
        <option value="">Selecciona una profesión</option>
        @foreach($professions as $profession)
            <option value="{{ $profession->id }}"{{ old('profession_id', $user->profile->profession_id) == $profession->id ? ' selected' : '' }}>
                {{ $profession->title }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Habilidades</label>
    <br>
    @foreach($skills as $skill)
        <div class="icheck-primary d-inline" style="margin-right: 5px">
            <input type="checkbox"
                    name="skills[{{ $skill->id }}]"
                    class="form-check-input"
                    id="skill_{{ $skill->id }}"
                    value="{{ $skill->id }}"
                {{ ($errors->any() ? old("skills.{$skill->id}") : $user->skills->contains($skill)) ? 'checked' : '' }}>
            <label class="form-check-label" for="skill_{{ $skill->id }}">{{ $skill->name }}</label>
        </div>
    @endforeach
</div>

@if($showStatus)
<div class="form-group">
    <label>Estado</label>
    <br>
    <div class="icheck-primary d-inline">
        <input type="checkbox"
               name="state"
               id="state"
               class="form-check-input"
               {{ $user->state ? 'checked' : '' }}>
        <label class="form-check-label" for="state">Activo</label>
    </div>
</div>
@endif
